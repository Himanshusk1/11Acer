<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index()
    {
        return view('about', [
            'active_page' => 'about',
        ]);
    }
}
