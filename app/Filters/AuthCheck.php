<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheck implements FilterInterface
{
    /**
     * Require authentication unless the route is flagged for guests.
     * Additional flags:
     *  - guest            : only guests may access route
     *  - disallow-admin   : authenticated admins get bounced to admin dashboard
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session        = session();
        $isLoggedIn     = (bool) $session->get('isLoggedIn');
        $role           = $session->get('role');
        $arguments      = $arguments ?? [];
        $isGuestRoute   = in_array('guest', $arguments, true);
        $disallowAdmin  = in_array('disallow-admin', $arguments, true);

        if ($isGuestRoute) {
            if ($isLoggedIn && $role) {
                return redirect()->to(role_dashboard_path($role));
            }
            return;
        }

        if (!$isLoggedIn) {
            return redirect()->to('/agents/login')->with('error', 'Please login to continue.');
        }

        if (!is_recognized_role($role)) {
            $session->destroy();
            return redirect()->to('/agents/login')->with('error', 'Your session has expired. Please login again.');
        }

        if ($disallowAdmin && $role === 'admin') {
            return redirect()->to(role_dashboard_path($role));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}