<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Must be logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/agents/login')->with('error', 'Please login to access admin area.');
        }

        // Must have role 'admin'
        $role = $session->get('role');
        if ($role !== 'admin') {
            $redirect = role_dashboard_path($role);
            return redirect()->to($redirect)->with('error', 'You are not authorized to access that page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}
