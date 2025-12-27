<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PropertyModel;
use App\Models\UserProfileModel;
use CodeIgniter\API\ResponseTrait;

class AgentController extends BaseController
{
    use ResponseTrait;

    protected $helpers = ['url'];

    protected $userModel;
    protected $propertyModel;
    protected $profileModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->propertyModel = new PropertyModel();
        $this->profileModel = new UserProfileModel();
    }

    /**
     * GET /api/agent/all
     * Returns all agents with optional filters and property counts.
     */
    public function all()
    {
        $city = $this->request->getGet('city');
        $service = $this->request->getGet('service'); // optional
        $search = $this->request->getGet('q');

    // Use the users table as the source of agents (role = 'agent')
    $builder = $this->userModel->builder();
    $builder->where('role', 'agent');
        if ($city) $builder->where('city', $city);
        if ($search) {
            $builder->groupStart()
                ->like('full_name', $search)
                ->orLike('agency_name', $search)
                ->orLike('city', $search)
            ->groupEnd();
        }

    $agents = $builder->get()->getResultArray();

        // Fetch property counts grouped by user_id
    $db = \Config\Database::connect();
        $propCounts = $db->table('properties_new')
            ->select('user_id, COUNT(*) as cnt')
            ->groupBy('user_id')
            ->get()
            ->getResultArray();

        $countsMap = [];
        foreach ($propCounts as $r) {
            $countsMap[$r['user_id']] = (int)$r['cnt'];
        }

        // fetch profiles in batch to avoid N queries
        $db = \Config\Database::connect();
        $profiles = $db->table('user_profiles')->select('user_id, photo_url, extra_data')->whereIn('user_id', array_column($agents, 'user_id'))->get()->getResultArray();
        $profilesMap = [];
        foreach ($profiles as $p) {
            $profilesMap[$p['user_id']] = $p;
        }

        $defaultAvatar = base_url('images/36_profile.png');

        // attach counts and profile extras to agents (matching agent_id to user_id)
        foreach ($agents as &$a) {
            $a['agent_id'] = $a['user_id'] ?? ($a['agent_id'] ?? null);
            $a['property_count'] = $countsMap[$a['user_id'] ?? $a['agent_id']] ?? 0;
            $prof = $profilesMap[$a['user_id']] ?? null;
            if ($prof) {
            $a['avatar'] = !empty($prof['photo_url']) ? $prof['photo_url'] : (!empty($a['profile_photo']) ? base_url('uploads/agents/' . $a['profile_photo']) : $defaultAvatar);
                $extra = [];
                if (!empty($prof['extra_data'])) $extra = json_decode($prof['extra_data'], true) ?: [];
                // merge known keys into root for card view compatibility
                $a['about'] = $extra['about'] ?? ($a['about'] ?? null);
                $a['experience'] = $extra['experience'] ?? ($a['experience'] ?? null);
                $a['team_size'] = $extra['team_members'] ?? ($extra['team_size'] ?? ($a['team_size'] ?? null));
                $a['office_location'] = $extra['office_location'] ?? ($a['office_location'] ?? null);
                if (empty($a['city']) && !empty($a['office_location'])) $a['city'] = $a['office_location'];
                $a['rera_number'] = $extra['rera_number'] ?? ($a['rera_number'] ?? null);
                $a['languages'] = $extra['languages'] ?? ($a['languages'] ?? null);
                $a['specializations'] = $extra['specializations'] ?? ($a['specializations'] ?? null);
            } else {
                $a['avatar'] = !empty($a['profile_photo']) ? base_url('uploads/agents/' . $a['profile_photo']) : $defaultAvatar;
            }
        }

        // sort by property_count desc for ranking convenience
        usort($agents, function($x, $y){ return ($y['property_count'] ?? 0) <=> ($x['property_count'] ?? 0); });

        return $this->respond(['status' => 'success', 'count' => count($agents), 'data' => $agents]);
    }

    /**
     * GET /api/agent/{id}
     * Return a single agent (from users table) by id.
     */
    public function show($id = null)
    {
        if (empty($id)) {
            return $this->failNotFound('Agent id missing');
        }

        $agent = $this->userModel->where('user_id', $id)->where('role', 'agent')->first();

        if (!$agent) {
            return $this->failNotFound('Agent not found');
        }

        // property count for this agent
        $db = \Config\Database::connect();
        $cnt = (int) $db->table('properties_new')->where('user_id', $agent['user_id'])->countAllResults();

        $agent['agent_id'] = $agent['user_id'];
        $agent['property_count'] = $cnt;

        // attach profile photo + extras if present
        $profile = $this->profileModel->getByUser($agent['user_id']);
        $defaultAvatar = base_url('images/36_profile.png');

        if ($profile) {
            $agent['avatar'] = !empty($profile['photo_url']) ? $profile['photo_url'] : (!empty($agent['profile_photo']) ? base_url('uploads/agents/' . $agent['profile_photo']) : $defaultAvatar);
            $extra = [];
            if (!empty($profile['extra_data'])) $extra = json_decode($profile['extra_data'], true) ?: [];
            $agent['about'] = $extra['about'] ?? ($agent['about'] ?? null);
            $agent['experience'] = $extra['experience'] ?? ($agent['experience'] ?? null);
            $agent['team_size'] = $extra['team_members'] ?? ($extra['team_size'] ?? ($agent['team_size'] ?? null));
            $agent['office_location'] = $extra['office_location'] ?? ($agent['office_location'] ?? null);
            if (empty($agent['city']) && !empty($agent['office_location'])) $agent['city'] = $agent['office_location'];
            $agent['rera_number'] = $extra['rera_number'] ?? ($agent['rera_number'] ?? null);
            $agent['languages'] = $extra['languages'] ?? ($agent['languages'] ?? null);
            $agent['specializations'] = $extra['specializations'] ?? ($agent['specializations'] ?? null);
        } else {
            $agent['avatar'] = !empty($agent['profile_photo']) ? base_url('uploads/agents/' . $agent['profile_photo']) : $defaultAvatar;
        }

        return $this->respond(['status' => 'success', 'data' => $agent]);
    }
}