<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use App\Models\UserOtpModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Psr\Log\LoggerInterface;

class AuthController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format    = 'json';
    protected array $serviceOptions = [
        'home_loan_assistance'   => 'Home Loan Assistance',
        'legal_documentation'    => 'Legal & Documentation Services',
        'vastu_consultation'     => 'Vastu Consultation',
        'home_painting_cleaning' => 'Home Painting & Cleaning',
        'repairs_utilities'      => 'Plumbing, Electrical & Carpentry',
        'construction_renovation'=> 'Home Construction & Renovation',
    ];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper(['public_id', 'referral_code']);
    }

    /**
     * Handles registration and profile updates.
     */
    public function register()
    {
        $input = $this->request->getJSON(true);
        if (!$input) {
            return $this->failValidationErrors(['error' => 'No input data provided']);
        }

        $userId = $input['user_id'] ?? null;
        $existingUser = null;
        if (!$userId && !empty($input['phone_number'])) {
            $existingUser = $this->model->where('phone_number', $input['phone_number'])->first();
            if ($existingUser) {
                $userId = $existingUser['user_id'];
            }
        }

        $emailRule = 'required|valid_email|is_unique[users.email]';
        $phoneRule = 'required|min_length[10]|max_length[20]|is_unique[users.phone_number]';

        if ($userId) {
            $emailRule = "required|valid_email|is_unique[users.email,user_id,{$userId}]";
            $phoneRule = "required|min_length[10]|max_length[20]|is_unique[users.phone_number,user_id,{$userId}]";
        }

        $rawRole = strtolower(trim((string) ($input['role'] ?? '')));
        $isServiceRole = $rawRole === 'service';
        $serviceRuleBase = 'in_list[' . implode(',', array_keys($this->serviceOptions)) . ']';
        $serviceRule = ($isServiceRole ? 'required' : 'permit_empty') . '|' . $serviceRuleBase;

        $rules = [
            'full_name'    => 'required|min_length[3]|max_length[255]',
            'email'        => $emailRule,
            'phone_number' => $phoneRule,
            'city'         => 'required|max_length[100]',
            'role'         => 'required|in_list[owner,agent,buyer,service]',
            'service'      => $serviceRule,
        ];

        $validation = \Config\Services::validation();
        $validation->setRules($rules);
        if (!$validation->run($input)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $role = $this->normalizeRole($input['role']);
        $serviceKey = $input['service'] ?? '';
        $serviceLabel = $this->serviceOptions[$serviceKey] ?? null;
        $serviceType = $role === 'service' ? $serviceLabel : null;
        $data = [
            'full_name'    => $input['full_name'],
            'email'        => $input['email'],
            'phone_number' => $input['phone_number'],
            'city'         => $input['city'],
            'role'         => $role,
            'service_type' => $serviceType,
        ];

        $publicId = '';

        if ($userId) {
            $currentUser = $existingUser ?? $this->model->find($userId);
            $publicId = $this->resolvePublicIdForRole($currentUser, $role);
            $data['public_id'] = $publicId;

            if ($this->model->update($userId, $data) === false) {
                return $this->failServerError($this->model->errors() ?: 'Failed to update user.');
            }
            $message = 'Details updated successfully';
        } else {
            $publicId = \generate_public_id($role);
            $data['public_id'] = $publicId;
            $userId = $this->model->insert($data);
            if (!$userId) {
                return $this->failServerError($this->model->errors() ?: 'Failed to register user.');
            }
            $message = 'Registration successful';
        }

        $user = $this->model->find($userId);
        if ($publicId !== '') {
            $this->syncReferralCode($userId, $publicId);
        }
        $user['role'] = $this->normalizeRole($user['role']);
        $serviceType = $user['role'] === 'service' ? ($user['service_type'] ?? null) : null;

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['user_id'],
            'role'       => $user['role'],
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
            'phone_number' => $user['phone_number'],
            'public_id'  => $user['public_id'],
            'service_type' => $serviceType,
        ]);

        return $this->respondCreated([
            'status'       => 'success',
            'message'      => $message,
            'user_id'      => $userId,
            'public_id'    => $user['public_id'],
            'redirect_url' => role_dashboard_path($user['role']),
            'service_type' => $serviceType,
        ]);
    }

    /**
     * Triggers login OTP flow, creating a quick profile when needed.
     */
    public function login()
    {
        $phone = $this->request->getVar('phone_number');
        if (!$phone) {
            return $this->failValidationErrors(['error' => 'Phone number is required']);
        }

        $user = $this->model->where('phone_number', $phone)->first();
        $isNewUser = false;

        if (!$user) {
            $isNewUser = true;
            $userId = $this->model->insert([
                'full_name'    => 'New User',
                'email'        => null,
                'phone_number' => $phone,
                'city'         => 'Unknown',
                'public_id'    => \generate_public_id('individual'),
                'role'         => 'individual',
            ]);

            $user = $this->model->find($userId);
            $message = 'Account not found. Created a provisional profile. OTP sent.';
        } else {
            if (empty($user['public_id'])) {
                $newPublicId = \generate_public_id($user['role'] ?? 'individual');
                $this->model->update($user['user_id'], ['public_id' => $newPublicId]);
                $user['public_id'] = $newPublicId;
            }
            $message = 'User account found. OTP sent successfully.';
        }

        if (! empty($user['public_id'])) {
            $this->syncReferralCode($user['user_id'], $user['public_id']);
        }

        $requiresProfile = $this->requiresProfileCompletion($user);
        $otp = rand(100000, 999999);

        $otpModel = new UserOtpModel();
        $otpModel->where('user_id', $user['user_id'])->delete();
        $otpModel->insert([
            'user_id'    => $user['user_id'],
            'otp_code'   => $otp,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $smsMessage = "Your 36 Booking Hub OTP is {$otp}. If you did not request this, ignore it.";
        $smsResult = $this->sendOtpSms($user['phone_number'], $smsMessage);

        return $this->respond([
            'message'          => $message,
            'otp'              => $otp,
            'user_id'          => $user['user_id'],
            'public_id'        => $user['public_id'],
            'is_new_user'      => $isNewUser,
            'requires_profile' => $requiresProfile,
            'sms_sent'         => $smsResult['ok'],
            'sms_message'      => $smsResult['message'],
        ]);
    }

    /**
     * Validates OTP and establishes the session.
     */
    public function verifyOtp()
    {
        $phone = $this->request->getVar('phone_number');
        $otp   = $this->request->getVar('otp');
        $userId = $this->request->getVar('user_id');

        if ((!$phone && !$userId) || !$otp) {
            return $this->failValidationErrors([
                'error' => 'Phone number or user_id and OTP are required'
            ]);
        }

        if ($userId) {
            $user = $this->model->find($userId);
        } else {
            $user = $this->model->where('phone_number', $phone)->first();
        }

        if (!$user) {
            return $this->failNotFound('User not found.');
        }

        if (empty($user['public_id'])) {
            $publicId = \generate_public_id($user['role'] ?? 'individual');
            $this->model->update($user['user_id'], ['public_id' => $publicId]);
            $user['public_id'] = $publicId;
        }

        if (! empty($user['public_id'])) {
            $this->syncReferralCode($user['user_id'], $user['public_id']);
        }

        $otpModel = new UserOtpModel();
        $record = $otpModel
            ->where('user_id', $user['user_id'])
            ->where('otp_code', $otp)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$record) {
            return $this->respond([
                'valid'   => false,
                'message' => 'Invalid or expired OTP',
            ], 401);
        }

        $user['role'] = $this->normalizeRole($user['role']);
        $serviceType = $user['role'] === 'service' ? ($user['service_type'] ?? null) : null;

        session()->set([
            'isLoggedIn' => true,
            'user_id'    => $user['user_id'],
            'role'       => $user['role'],
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
            'phone_number' => $user['phone_number'],
            'public_id'  => $user['public_id'],
            'service_type' => $serviceType,
        ]);

        $otpModel->delete($record['otp_id']);

        $requiresProfile = $this->requiresProfileCompletion($user);
        $response = [
            'valid'             => true,
            'requires_profile'  => $requiresProfile,
            'message'           => $requiresProfile
                ? 'OTP verified. Please complete your profile to continue.'
                : 'OTP verified successfully. Redirecting to your dashboard.',
            'user'              => [
                'user_id'      => $user['user_id'],
                'full_name'    => $user['full_name'],
                'email'        => $user['email'],
                'phone_number' => $user['phone_number'],
                'role'         => $user['role'],
                'public_id'    => $user['public_id'],
                'city'         => $user['city'],
                'service_type' => $serviceType,
            ],
        ];

        if (!$requiresProfile) {
            $response['redirect_url'] = role_dashboard_path($user['role']);
        }

        return $this->respond($response);
    }

    /**
     * Logs the user out and returns a friendly response.
     */
    public function logout()
    {
        session()->destroy();

        if ($this->request->isAJAX()) {
            return $this->respond(['message' => 'Logged out successfully']);
        }

        return redirect()->to('/')->with('message', 'Logged out successfully');
    }

    protected function sendOtpSms(string $number, string $message): array
    {
        $apiUrl = 'https://int.chatway.in/api/send-msg';
        $username = getenv('CHATWAY_USERNAME') ?: '36Brokinghub';
        $token = getenv('CHATWAY_TOKEN') ?: 'fkfdfjdfjkdfjdfdsfjk';

        $verifySslEnv = getenv('CHATWAY_VERIFY_SSL');
        $verifySsl = $verifySslEnv === false
            ? false
            : filter_var($verifySslEnv, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if ($verifySsl === null) {
            $verifySsl = false;
        }

        $cleanNumber = preg_replace('/\D+/', '', $number);
        if (strpos($cleanNumber, '91') !== 0) {
            $cleanNumber = '91' . ltrim($cleanNumber, '0');
        }

        $url = sprintf(
            "%s?username=%s&number=%s&message=%s&token=%s",
            $apiUrl,
            urlencode($username),
            urlencode($cleanNumber),
            urlencode($message),
            urlencode($token)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $verifySsl ? 2 : 0);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($error
            && stripos($error, 'SSL certificate problem') !== false
            && $verifySsl
        ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $response = curl_exec($ch);
            $error = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            log_message('warning', 'sendOtpSms SSL fallback executed: ' . $error);
        }

        curl_close($ch);

        $ok = $error === '' && $httpCode >= 200 && $httpCode < 300;
        $messagePayload = $error ?: 'OTP queued for delivery.';

        return [
            'ok'        => $ok,
            'message'   => $messagePayload,
            'response'  => $response,
            'http_code' => $httpCode,
        ];
    }

    private function syncReferralCode(int $userId, string $publicId): void
    {
        $publicId = trim((string) $publicId);
        if ($publicId === '') {
            return;
        }

        try {
            ensure_referral_code_for_user($userId, $publicId);
        } catch (\Throwable $e) {
            log_message('error', 'Referral code sync failed for user ' . $userId . ': ' . $e->getMessage());
        }
    }

    protected function normalizeRole(?string $role): string
    {
        $role = strtolower(trim((string) $role));
        $map = [
            'owner'      => 'owner',
            'agent'      => 'agent',
            'buyer'      => 'buyer',
            'builder'    => 'builder',
            'admin'      => 'admin',
            'individual' => 'individual',
            'broker'     => 'agent',
            'service'    => 'service',
        ];

        return $map[$role] ?? 'buyer';
    }

    protected function requiresProfileCompletion(array $user): bool
    {
        $required = ['full_name', 'email', 'city', 'role'];

        foreach ($required as $field) {
            if (empty($user[$field])) {
                return true;
            }
        }

        $normalizedRole = $this->normalizeRole($user['role'] ?? '');
        if ($normalizedRole === 'service' && empty($user['service_type'])) {
            return true;
        }

        return false;
    }

    protected function resolvePublicIdForRole(?array $user, string $role): string
    {
        $expectedPrefix = $this->publicIdPrefixForRole($role);
        $existingPublicId = $user['public_id'] ?? '';

        if ($existingPublicId !== '' && $this->publicIdPrefixFromValue($existingPublicId) === $expectedPrefix) {
            return $existingPublicId;
        }

        return \generate_public_id($role);
    }

    protected function publicIdPrefixForRole(string $role): string
    {
        $map = [
            'agent'      => 'AG',
            'individual' => 'IN',
            'builder'    => 'BU',
            'buyer'      => 'BY',
            'admin'      => 'AD',
            'owner'      => 'AG',
            'broker'     => 'AG',
            'service'    => 'SV',
        ];

        $normalized = strtolower(trim($role));
        return $map[$normalized] ?? 'US';
    }

    protected function publicIdPrefixFromValue(string $publicId): string
    {
        $parts = explode('-', $publicId, 2);
        return strtoupper($parts[0] ?? '');
    }
}
