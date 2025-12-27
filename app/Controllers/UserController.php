<?php

namespace App\Controllers;

class UserController extends BaseController
{
    /**
     * Render the redesigned user dashboard themed post-property flow.
     */
    public function postProperty()
    {
        $session = session();

        $data = [
            'page_title'  => 'Post Your Property',
            'active_page' => 'dashboard',
        ];

        if ($session->get('isLoggedIn')) {
            // Logged-in users should work inside the gated flow
            return redirect()->to('/post-your-property');
        }

        return view('post-property', $data);
    }

    /**
     * Authenticated property-posting workspace.
     */
    public function postYourProperty()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/agents/login')->with('error', 'Please login to continue.');
        }

        $data = [
            'page_title'  => 'Post Your Property',
            'active_page' => 'dashboard',
        ];

        return view('user/post-your-property', $data);
    }
}
