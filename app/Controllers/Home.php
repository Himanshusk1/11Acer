<?php

namespace App\Controllers;

use App\Models\PropertyModel;
use App\Models\PropertyDetailModel;
use App\Models\PropertyPricingModel;
use App\Models\ServiceEnquiryModel;
class Home extends BaseController
{
    // Home Page
    public function index()
    {
        $propertyModel = new PropertyModel();
        $detailModel = new PropertyDetailModel();
        $pricingModel = new PropertyPricingModel();
        $trendingCategories = $propertyModel
            ->select('property_category, COUNT(id) AS listing_count')
            ->where('status', 'published')
            ->where('property_category !=', '')
            ->groupBy('property_category')
            ->orderBy('listing_count', 'DESC')
            ->limit(6)
            ->findAll();

        $trendingCities = $propertyModel
            ->select('city, COUNT(id) AS listing_count')
            ->where('status', 'published')
            ->where('city !=', '')
            ->groupBy('city')
            ->orderBy('listing_count', 'DESC')
            ->limit(4)
            ->findAll();

        $popularLocalities = $propertyModel
            ->select('city, locality, COUNT(id) AS listing_count')
            ->where('status', 'published')
            ->where('locality !=', '')
            ->groupBy('city, locality')
            ->orderBy('listing_count', 'DESC')
            ->limit(6)
            ->findAll();

        $cityStats = $propertyModel
            ->select('properties_new.city, COUNT(properties_new.id) AS listing_count, AVG(property_pricing.price) AS avg_price')
            ->join('property_pricing', 'property_pricing.property_id = properties_new.id', 'left')
            ->where('properties_new.status', 'published')
            ->where('properties_new.city !=', '')
            ->groupBy('properties_new.city')
            ->orderBy('listing_count', 'DESC')
            ->limit(4)
            ->findAll();

        $recentProperties = $propertyModel
            ->where('status', 'published')
            ->orderBy('updated_at', 'DESC')
            ->limit(4)
            ->findAll();

        $recentIds = array_column($recentProperties, 'id');
        $detailRows = [];
        if (!empty($recentIds)) {
            $detailRows = $detailModel->whereIn('property_id', $recentIds)->findAll();
        }

        $pricingRows = [];
        if (!empty($recentIds)) {
            $pricingRows = $pricingModel->whereIn('property_id', $recentIds)->findAll();
        }

        $detailMap = [];
        foreach ($detailRows as $detail) {
            $detailMap[$detail['property_id']] = json_decode($detail['details_json'], true) ?? [];
        }

        $pricingMap = [];
        foreach ($pricingRows as $pricing) {
            $pricingMap[$pricing['property_id']] = $pricing;
        }

        foreach ($recentProperties as &$prop) {
            $prop['details'] = $detailMap[$prop['id']] ?? [];
            $prop['pricing'] = $pricingMap[$prop['id']] ?? null;
        }
        unset($prop);

        $data = [
            'page_title'          => 'Home',
            'active_page'         => null,
            'trendingCategories'  => $trendingCategories ?: [],
            'trendingCities'      => $trendingCities ?: [],
            'popularLocalities'   => $popularLocalities ?: [],
            'cityStats'           => $cityStats ?: [],
            'recentProperties'    => $recentProperties ?: []
        ];
        return view('home', $data);
    }

    public function properties()
    {
        $data = [
            'page_title'  => 'All Properties',
            'active_page' => 'buyers'
        ];
        return view('properties');
    }

    public function temp()
    {
        $data = [
            'page_title'  => 'Temp Page',
            'active_page' => 'buyers'
        ];
        return view('temp', $data);
    }

    public function property()
    {
        $data = [
            'page_title'  => 'Property Details',
            'active_page' => 'buyers'
        ];
        return view('property');
    }
     
    // Dealer Page
    public function commercial()
    {
        $propertyModel = new PropertyModel();
        $detailModel = new PropertyDetailModel();
        $pricingModel = new PropertyPricingModel();

        $commercialListings = $propertyModel
            ->where('status', 'published')
            ->where('property_category', 'commercial')
            ->orderBy('updated_at', 'DESC')
            ->limit(6)
            ->findAll();

        $commercialIds = array_column($commercialListings, 'id');
        $detailRows = [];
        if (!empty($commercialIds)) {
            $detailRows = $detailModel->whereIn('property_id', $commercialIds)->findAll();
        }

        $pricingRows = [];
        if (!empty($commercialIds)) {
            $pricingRows = $pricingModel->whereIn('property_id', $commercialIds)->findAll();
        }

        $detailMap = [];
        foreach ($detailRows as $detail) {
            $detailMap[$detail['property_id']] = json_decode($detail['details_json'], true) ?? [];
        }

        $pricingMap = [];
        foreach ($pricingRows as $pricing) {
            $pricingMap[$pricing['property_id']] = $pricing;
        }

        foreach ($commercialListings as &$listing) {
            $listing['details'] = $detailMap[$listing['id']] ?? [];
            $listing['pricing'] = $pricingMap[$listing['id']] ?? null;
        }
        unset($listing);

        $corridorRows = $propertyModel
            ->select('city, locality, COUNT(id) AS listing_count')
            ->where('status', 'published')
            ->where('property_category', 'commercial')
            ->where('city !=', '')
            ->where('locality !=', '')
            ->groupBy('city, locality')
            ->orderBy('listing_count', 'DESC')
            ->findAll();

        $cityCorridorMap = [];
        foreach ($corridorRows as $row) {
            $city = $row['city'];
            $locality = $row['locality'];
            if (!isset($cityCorridorMap[$city])) {
                $cityCorridorMap[$city] = [];
            }
            $cityCorridorMap[$city][$locality] = (int) $row['listing_count'];
        }

        $cityTotals = [];
        foreach ($cityCorridorMap as $city => $localities) {
            $cityTotals[$city] = array_sum($localities);
        }
        arsort($cityTotals);

        $cityCorridors = [];
        $cityCorridorChips = [];
        if (!empty($cityTotals)) {
            $topCities = array_slice(array_keys($cityTotals), 0, 6);
            foreach ($topCities as $city) {
                $localities = $cityCorridorMap[$city] ?? [];
                arsort($localities);
                $topLocalities = array_slice(array_keys($localities), 0, 3);
                $cityCorridors[] = [
                    'name' => $city,
                    'areas' => $topLocalities ? implode(', ', $topLocalities) : 'Pan-city coverage',
                ];
            }
            $cityCorridorChips = array_slice(array_keys($cityTotals), 6, 6);
        }

        if (empty($cityCorridors)) {
            $cityCorridors = [
                ['name'=>'Mumbai','areas'=>'BKC, Lower Parel, Navi Mumbai SEZ'],
                ['name'=>'Delhi NCR','areas'=>'Cyber City, Aerocity, Noida Expressway'],
                ['name'=>'Bengaluru','areas'=>'Outer Ring Road, Whitefield, North Bengaluru'],
                ['name'=>'Hyderabad','areas'=>'Gachibowli, Hitec City, Kokapet'],
                ['name'=>'Pune','areas'=>'Hinjewadi, Baner-Balewadi, Kharadi'],
                ['name'=>'Chennai','areas'=>'OMR, Guindy, Oragadam'],
            ];
        }

        if (empty($cityCorridorChips)) {
            $cityCorridorChips = ['Ahmedabad','Kolkata','Indore','Jaipur','Cochin'];
        }

        $data = [
            'page_title'  => 'Commercial Properties',
            'active_page' => 'commercial' 
        ];
        $data['commercialListings'] = $commercialListings ?: [];
        $data['cityCorridors'] = $cityCorridors;
        $data['cityCorridorChips'] = $cityCorridorChips;
        
        return view('commercial', $data); 
    }
    public function residential()
    {
        $propertyModel = new PropertyModel();
        $detailModel = new PropertyDetailModel();
        $pricingModel = new PropertyPricingModel();

        $residentialListings = $propertyModel
            ->where('status', 'published')
            ->where('property_category', 'residential')
            ->orderBy('updated_at', 'DESC')
            ->limit(6)
            ->findAll();

        $residentialIds = array_column($residentialListings, 'id');
        $detailRows = [];
        if (!empty($residentialIds)) {
            $detailRows = $detailModel->whereIn('property_id', $residentialIds)->findAll();
        }

        $pricingRows = [];
        if (!empty($residentialIds)) {
            $pricingRows = $pricingModel->whereIn('property_id', $residentialIds)->findAll();
        }

        $detailMap = [];
        foreach ($detailRows as $detail) {
            $detailMap[$detail['property_id']] = json_decode($detail['details_json'], true) ?? [];
        }

        $pricingMap = [];
        foreach ($pricingRows as $pricing) {
            $pricingMap[$pricing['property_id']] = $pricing;
        }

        foreach ($residentialListings as &$listing) {
            $listing['details'] = $detailMap[$listing['id']] ?? [];
            $listing['pricing'] = $pricingMap[$listing['id']] ?? null;
        }
        unset($listing);

        $data = [
            'page_title'  => 'Residential Properties',
            'active_page' => 'residential',
            'residentialListings' => $residentialListings ?: []
        ];

        return view('residential', $data); 
    }

    // Services Page
    public function services()
    {
        $data = [
            'page_title'  => 'Our Services',
            'active_page' => 'services'
        ];
        return view('services_page', $data);
    }

    public function submitServiceEnquiry()
    {
        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request.',
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ]);
        }

        $input = $this->request->getJSON(true) ?? [];
        if (! is_array($input)) {
            $input = $this->request->getPost();
        }

        $rules = [
            'name' => 'required|trim|min_length[3]|max_length[150]',
            'phone' => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\) ]+$/]',
            'email' => 'required|valid_email|max_length[150]',
            'message' => 'required|min_length[10]|max_length[1000]',
            'service_title' => 'required|min_length[3]|max_length[200]',
        ];

        $payload = [
            'name' => trim($input['name'] ?? ''),
            'phone' => trim($input['phone'] ?? ''),
            'email' => trim($input['email'] ?? ''),
            'message' => trim($input['message'] ?? ''),
            'service_title' => trim($input['service_title'] ?? ''),
        ];

        if (! $this->validate($rules, $payload)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status' => 'error',
                'message' => 'Please review the highlighted fields.',
                'errors' => $this->validator->getErrors(),
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ]);
        }

        $model = new ServiceEnquiryModel();

        if ($model->insert($payload) === false) {
            log_message('error', 'Failed to save service enquiry', $payload);
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'We could not save your enquiry just now. Please try again shortly.',
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Thanks for reaching out. Our concierge will reach out soon.',
            'csrfToken' => csrf_token(),
            'csrfHash' => csrf_hash(),
        ]);
    }
    
    // Agents Page
    public function agents()
    {
        $data = [
            'page_title'  => 'Our Agents',
            'active_page' => 'agents'
        ];
        return view('agents/agents_page', $data);
    }

}