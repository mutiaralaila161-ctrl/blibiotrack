<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // ❌ BELUM LOGIN
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // 🔐 ROLE CHECK (JIKA ADA ARGUMEN)
        if (!empty($arguments)) {

            $userRole = $session->get('role');

            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/')->with('error', 'Akses ditolak');
            }
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak digunakan
    }
}