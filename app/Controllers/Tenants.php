<?php

namespace App\Controllers;

class Tenants extends BaseController
{
    public function index()
    {
        return view('tenants', [
            'active_page' => 'tenants',
        ]);
    }
}
