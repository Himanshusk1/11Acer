<?php

namespace App\Controllers;

class OwnerBuilder extends BaseController
{
    public function index()
    {
        return view('owner-builder', [
            'active_page' => 'owner',
        ]);
    }
}
