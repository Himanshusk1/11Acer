<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SubscriptionModel;
use App\Models\UserSubscriptionModel;
use App\Models\PropertyModel;
use App\Models\ReferralCodeModel;
use App\Models\ReferralCodeUsageModel;
use App\Models\RazorpayTransactionModel;
use App\Models\InvoiceModel;
use App\Models\UserModel;
use App\Services\InvoiceService;
use Config\Services;

class Subscriptions extends ResourceController
{
    private const REFERRAL_DISCOUNT_TYPE = 'percentage';
    private const REFERRAL_DISCOUNT_VALUE = 10.0;

    protected $format = 'json';
    protected SubscriptionModel $subscriptionModel;
    protected UserSubscriptionModel $userSubscriptionModel;
    protected PropertyModel $propertyModel;
    protected ReferralCodeModel $referralCodeModel;
    protected ReferralCodeUsageModel $referralCodeUsageModel;
    protected RazorpayTransactionModel $razorpayTransactionModel;
    protected InvoiceService $invoiceService;
    protected InvoiceModel $invoiceModel;
    protected UserModel $userModel;
    private const RAZORPAY_API_URL = 'https://api.razorpay.com/v1/orders';
    private const RAZORPAY_KEY_ID = 'rzp_live_Rw9EmNpHAltvjz';
    private const RAZORPAY_KEY_SECRET = 'TqeiHbA2rdfop6Fa1End34gi';

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
        $this->userSubscriptionModel = new UserSubscriptionModel();
        $this->propertyModel = new PropertyModel();
        $this->referralCodeModel = new ReferralCodeModel();
        $this->referralCodeUsageModel = new ReferralCodeUsageModel();
        $this->razorpayTransactionModel = new RazorpayTransactionModel();
        $this->invoiceModel = new InvoiceModel();
        $this->invoiceService = new InvoiceService($this->invoiceModel);
        $this->userModel = new UserModel();
    }

    // GET /api/subscriptions
    public function index()
    {
        $subs = $this->subscriptionModel->orderBy('price', 'ASC')->findAll();
        return $this->respond(['status' => 'success', 'data' => $subs]);
    }

    // POST /api/subscriptions/subscribe
    public function subscribe()
    {
        $userId = session()->get('user_id');
        if (!$userId) return $this->failUnauthorized('Not logged in');

        $subId = $this->request->getPost('subscription_id');
        if (!$subId) return $this->failValidationErrors('subscription_id is required');

        $sub = $this->subscriptionModel->find($subId);
        if (!$sub) return $this->failNotFound('Subscription not found');

        $referralCodeValue = trim((string) $this->request->getPost('referral_code'));
        $paymentMethod = $this->request->getPost('payment_method') ?: 'dashboard';
        $paymentReference = $this->request->getPost('payment_reference') ?: 'manual-' . time();

        $pricingContext = $this->buildReferralContext($sub, $referralCodeValue, $userId);
        if ($pricingContext['error']) {
            return $this->failValidationErrors($pricingContext['error']);
        }

        $canUseReferral = $pricingContext['allow_referral'];
        $applyReferral = $pricingContext['apply_referral'];
        $discountAmount = $pricingContext['discount_amount'];
        $finalPrice = $pricingContext['final_price'];
        $referralRow = $pricingContext['referral_row'];

        // deactivate existing active subscriptions
        $this->userSubscriptionModel->where('user_id', $userId)->where('active', 1)->set(['active' => 0])->update();

        $starts = new \DateTime();
        $expires = (clone $starts)->modify('+' . (int)$sub['duration_days'] . ' days');

        $data = [
            'user_id' => $userId,
            'subscription_id' => $subId,
            'starts_at' => $starts->format('Y-m-d H:i:s'),
            'expires_at' => $expires->format('Y-m-d H:i:s'),
            'active' => 1
        ];

        $subscriptionInsertId = $this->userSubscriptionModel->insert($data);

        if ($applyReferral && $subscriptionInsertId) {
            $usage = [
                'referral_code_id' => $referralRow['referral_code_id'],
                'referrer_user_id' => $referralRow['user_id'],
                'used_by_user_id' => $userId,
                'used_for_subscription_id' => $subscriptionInsertId,
                'discount_type' => self::REFERRAL_DISCOUNT_TYPE,
                'discount_value' => self::REFERRAL_DISCOUNT_VALUE,
                'discount_amount' => $discountAmount,
                'paid_amount' => $finalPrice,
                'payment_method' => $paymentMethod,
                    'payment_status' => $paymentMethod === 'razorpay' ? 'paid' : 'pending',
            ];

            $this->referralCodeUsageModel->insert($usage);
        }

        $responsePayload = [
            'status' => 'success',
            'message' => 'Subscribed',
            'data' => array_merge($data, ['id' => $subscriptionInsertId]),
            'discount_applied' => $applyReferral,
            'discount_amount' => $discountAmount,
            'final_price' => $finalPrice,
            'can_use_referral' => $this->canUseReferral($userId),
            'invoice' => null,
            'invoice_pdf_path' => null,
        ];

        if ($subscriptionInsertId) {
            $invoice = $this->createInvoiceForSubscription($userId, $sub, $finalPrice, $paymentReference ?? null);
            if ($invoice) {
                $responsePayload['invoice'] = $invoice['invoice'] ?? null;
                $responsePayload['invoice_pdf_path'] = $invoice['pdf_path'] ?? null;
            }
        }

        return $this->respondCreated($responsePayload);
    }

    // POST /api/subscriptions/order
    public function createOrder()
    {
        $userId = session()->get('user_id');
        if (!$userId) return $this->failUnauthorized('Not logged in');

        $subId = $this->request->getPost('subscription_id');
        if (!$subId) return $this->failValidationErrors('subscription_id is required');

        $sub = $this->subscriptionModel->find($subId);
        if (!$sub) return $this->failNotFound('Subscription not found');

        $referralCodeValue = trim((string) $this->request->getPost('referral_code'));
        $pricingContext = $this->buildReferralContext($sub, $referralCodeValue, $userId);
        if ($pricingContext['error']) {
            return $this->failValidationErrors($pricingContext['error']);
        }

        $finalPrice = $pricingContext['final_price'];
        if ($finalPrice <= 0) {
            return $this->respond([
                'status' => 'success',
                'requires_payment' => false,
                'final_price' => $finalPrice,
                'subscription' => $sub,
                'discount_applied' => $pricingContext['apply_referral'],
                'discount_amount' => $pricingContext['discount_amount'],
                'can_use_referral' => $pricingContext['allow_referral'],
            ]);
        }

        $amountPaise = (int) round($finalPrice * 100);
        $payload = null;

        try {
            $client = Services::curlrequest([
                'auth' => [self::RAZORPAY_KEY_ID, self::RAZORPAY_KEY_SECRET],
                'http_errors' => false,
                'timeout' => 30,
                // Disable SSL verification locally if a self-signed proxy/CA is blocking Razorpay;
                // keep this disabled only when developing on a machine with a self-signed certificate.
                'verify' => false,
                'curloptions' => [
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                ],
            ]);
            $resp = $client->post(self::RAZORPAY_API_URL, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'amount' => $amountPaise,
                    'currency' => 'INR',
                    'receipt' => sprintf('sub_%d_%d_%d', $userId, $subId, time()),
                    'payment_capture' => 1,
                    'notes' => [
                        'user_id' => $userId,
                        'subscription_id' => $subId,
                        'subscription_name' => $sub['name'] ?? '',
                    ],
                ],
            ]);
            $status = $resp->getStatusCode();
            $payload = json_decode((string) $resp->getBody(), true);
            if ($status < 200 || $status >= 300 || empty($payload['id'])) {
                $message = $payload['error']['description'] ?? 'Failed to initialize payment.';
                log_message('error', 'Razorpay order error: ' . json_encode($payload));
                return $this->failServerError($message);
            }
        } catch (\Throwable $ex) {
            log_message('error', 'Razorpay order exception: ' . $ex->getMessage());
            return $this->failServerError('Failed to contact Razorpay.');
        }

        $payloadJson = $this->encodeToJson($payload);
        $notesJson = null;
        if (! empty($payload['notes']) && is_array($payload['notes'])) {
            $notesJson = $this->encodeToJson($payload['notes']);
        }

        $transactionData = [
            'user_id' => $userId,
            'subscription_id' => $subId,
            'referral_code' => $referralCodeValue ?: null,
            'order_id' => $payload['id'] ?? null,
            'amount' => isset($payload['amount']) ? (int) $payload['amount'] : $amountPaise,
            'currency' => $payload['currency'] ?? 'INR',
            'status' => $payload['status'] ?? 'created',
            'payment_capture' => isset($payload['payment_capture']) ? (int) $payload['payment_capture'] : 0,
            'receipt' => $payload['receipt'] ?? null,
            'discount_applied' => $pricingContext['apply_referral'] ? 1 : 0,
            'discount_amount' => $pricingContext['discount_amount'],
            'final_price' => $finalPrice,
            'notes' => $notesJson,
            'order_payload' => $payloadJson,
        ];

        $transactionId = $this->razorpayTransactionModel->insert($transactionData);
        if (! $transactionId) {
            log_message('error', 'Failed to persist Razorpay order ' . ($payload['id'] ?? 'n/a'));
        }

        return $this->respond([
            'status' => 'success',
            'requires_payment' => true,
            'order_id' => $payload['id'],
            'amount' => $payload['amount'],
            'currency' => $payload['currency'],
            'order' => $payload,
            'subscription' => $sub,
            'final_price' => $finalPrice,
            'discount_applied' => $pricingContext['apply_referral'],
            'discount_amount' => $pricingContext['discount_amount'],
            'can_use_referral' => $pricingContext['allow_referral'],
            'razorpay_key' => self::RAZORPAY_KEY_ID,
            'transaction_id' => $transactionId ?: null,
        ]);
    }

    // GET /api/subscriptions/status
    public function status()
    {
        $userId = session()->get('user_id');
        $role = session()->get('role') ?? 'user';
        $canUseReferral = $userId ? $this->canUseReferral($userId) : false;

        $resp = ['can_post' => false, 'reason' => '', 'active_subscription' => null, 'last_post_at' => null, 'days_left' => null, 'can_use_referral' => $canUseReferral];

        if (!$userId) {
            $resp['reason'] = 'not_logged_in';
            return $this->respond($resp);
        }

        // check active subscription
        $now = date('Y-m-d H:i:s');
        $active = $this->userSubscriptionModel
            ->where('user_id', $userId)
            ->where('active', 1)
            ->where('expires_at >', $now)
            ->orderBy('expires_at', 'DESC')
            ->first();

        if ($active) {
            $sub = $this->subscriptionModel->find($active['subscription_id']);
            $resp['active_subscription'] = array_merge($active, ['subscription' => $sub]);
            $resp['can_post'] = true;
            $expires = new \DateTime($active['expires_at']);
            $nowdt = new \DateTime();
            $diff = $nowdt->diff($expires);
            $resp['days_left'] = (int)$diff->format('%a');
            return $this->respond($resp);
        }

        // If agent -> must subscribe
        if ($role === 'agent') {
            $resp['reason'] = 'agent_must_subscribe';
            return $this->respond($resp);
        }

        // normal user: allow first post for free; after that require purchase or wait 90 days
        $count = $this->propertyModel->where('user_id', $userId)->countAllResults();
        if ($count == 0) {
            $resp['can_post'] = true;
            return $this->respond($resp);
        }

        // get last post
        $last = $this->propertyModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
        if ($last && !empty($last['created_at'])) {
            $resp['last_post_at'] = $last['created_at'];
            $lastdt = new \DateTime($last['created_at']);
            $nowdt = new \DateTime();
            $diff = $nowdt->diff($lastdt);
            $days = (int)$diff->format('%a');
            if ($days >= 90) {
                $resp['can_post'] = true;
            } else {
                $resp['reason'] = 'cooldown';
                $resp['days_left'] = 90 - $days;
            }
        } else {
            // fallback: no created_at; be permissive and allow posting
            $resp['can_post'] = true;
        }

        return $this->respond($resp);
    }

    private function canUseReferral(int $userId): bool
    {
        $used = $this->referralCodeUsageModel->where('used_by_user_id', $userId)->countAllResults();
        if ($used > 0) {
            return false;
        }

        $existingSubscriptions = $this->userSubscriptionModel->where('user_id', $userId)->countAllResults();
        return $existingSubscriptions === 0;
    }

    private function calculateReferralDiscount(float $price): float
    {
        if ($price <= 0) {
            return 0.0;
        }

        if (self::REFERRAL_DISCOUNT_TYPE === 'percentage') {
            return round($price * (self::REFERRAL_DISCOUNT_VALUE / 100), 2);
        }

        return min($price, self::REFERRAL_DISCOUNT_VALUE);
    }

    private function buildReferralContext(array $subscription, string $referralCodeValue, int $userId): array
    {
        $canUseReferral = $this->canUseReferral($userId);
        $applyReferral = false;
        $discountAmount = 0.0;
        $finalPrice = (float) $subscription['price'];
        $referralRow = null;

        if ($referralCodeValue !== '') {
            if (! $canUseReferral) {
                return ['error' => 'Referral code can only be used for your first subscription.'];
            }

            $referralRow = $this->referralCodeModel->where('code', $referralCodeValue)->first();
            if (! $referralRow) {
                return ['error' => 'Referral code is invalid.'];
            }

            if ((int) ($referralRow['user_id'] ?? 0) === (int) $userId) {
                return ['error' => 'You cannot use your own referral code.'];
            }

            $applyReferral = true;
            $discountAmount = $this->calculateReferralDiscount($finalPrice);
            $finalPrice = max(0, $finalPrice - $discountAmount);
        }

        return [
            'subscription' => $subscription,
            'final_price' => $finalPrice,
            'discount_amount' => $discountAmount,
            'apply_referral' => $applyReferral,
            'referral_row' => $referralRow,
            'allow_referral' => $canUseReferral,
            'error' => null,
        ];
    }

    private function createInvoiceForSubscription(int $userId, array $subscription, float $finalPrice, ?string $orderReference): ?array
    {
        try {
            $customer = $this->buildCustomerContext($userId);
            $items = [[
                'description' => ($subscription['name'] ?? 'Subscription') . ' (' . ((int) ($subscription['duration_days'] ?? 0)) . ' days)',
                'hsn' => $subscription['hsn_code'] ?? '9983',
                'qty' => 1,
                'rate' => $finalPrice,
                'amount' => $finalPrice,
            ]];

            return $this->invoiceService->generate([
                'user_id' => $userId,
                'subscription_id' => $subscription['id'] ?? $subscription['subscription_id'] ?? null,
                'subscription_name' => $subscription['name'] ?? 'Subscription',
                'order_id' => $orderReference,
                'amount_before_tax' => $finalPrice,
                'tax_rate_percent' => 18.0,
                'items' => $items,
                'customer' => $customer,
                'customer_address' => $customer['address'],
            ]);
        } catch (\Throwable $ex) {
            log_message('error', 'Invoice generation failed: ' . $ex->getMessage());
            return null;
        }
    }

    private function buildCustomerContext(int $userId): array
    {
        $user = $this->userModel->find($userId);
        $addressParts = [];
        if (! empty($user['city'])) {
            $addressParts[] = $user['city'];
        }
        if (! empty($user['state'])) {
            $addressParts[] = $user['state'];
        }
        if (! empty($user['country'])) {
            $addressParts[] = $user['country'];
        }

        return [
            'name' => $user['full_name'] ?? 'Retail Customer',
            'gstin' => $user['gstin'] ?? null,
            'email' => $user['email'] ?? null,
            'phone' => $user['phone_number'] ?? null,
            'address' => $addressParts ? implode(', ', $addressParts) : 'N/A',
        ];
    }

    private function encodeToJson(mixed $value): ?string
    {
        $encoded = json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return $encoded === false ? null : $encoded;
    }
}
