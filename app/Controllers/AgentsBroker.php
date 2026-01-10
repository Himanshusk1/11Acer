<?php

namespace App\Controllers;

class AgentsBroker extends BaseController
{
    public function index()
    {
        return view('agents-broker', [
            'active_page' => 'agents',
        ]);
    }
}
