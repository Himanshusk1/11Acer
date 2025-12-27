<?php

namespace App\Controllers;

class Agents extends BaseController
{
    public function login()
    {
        // View ko batayein ki 'login' form dikhana hai
        $data['form_to_show'] = 'login'; 
        return view('agents/agents_auth', $data); // Apne view ka naam yahan likhein
    }

    public function register()
    {
        // View ko batayein ki 'register' form dikhana hai
        $data['form_to_show'] = 'register';
        return view('agents/agents_auth', $data); // Apne view ka naam yahan likhein
    }

    public function profile()
    {
        return view('agents/agent_profile');
    }
}