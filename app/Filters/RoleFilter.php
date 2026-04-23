<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $role = $session->get('role');

        // belum login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // kalau ada aturan role
        if ($arguments) {

            // ADMIN selalu lolos (kecuali kamu blok manual)
            if ($role === 'admin') {
                return;
            }

            if (!in_array($role, $arguments)) {
                return redirect()->to('/dashboard')
                    ->with('error', 'Akses ditolak');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}