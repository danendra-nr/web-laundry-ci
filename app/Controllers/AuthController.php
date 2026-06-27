<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $role = $user['role'] ?? 'admin';
            $sessionData = [
                'id'           => $user['id'],
                'username'     => $user['username'],
                'role'         => $role,
                'pelanggan_id' => $user['pelanggan_id'] ?? null,
                'isLoggedIn'   => true,
            ];
            session()->set($sessionData);
            
            if ($role === 'pelanggan') {
                return redirect()->to('/customer/dashboard')->with('success', 'Selamat datang kembali, ' . htmlspecialchars($username) . '!');
            }
            return redirect()->to('/dashboard')->with('success', 'Selamat datang kembali, ' . htmlspecialchars($username) . '!');
        }

        return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') === 'pelanggan') {
                return redirect()->to('/customer/dashboard');
            }
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function registerProcess()
    {
        $rules = [
            'username'         => 'required|is_unique[users.username]|min_length[3]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
            'nama'             => 'required|min_length[2]',
            'no_hp'            => 'required|numeric|min_length[9]',
            'alamat'           => 'required|min_length[5]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Insert into pelanggan
        $pelangganData = [
            'nama'       => $this->request->getPost('nama'),
            'no_hp'      => $this->request->getPost('no_hp'),
            'alamat'     => $this->request->getPost('alamat'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $db->table('pelanggan')->insert($pelangganData);
        $pelangganId = $db->insertID();

        // 2. Insert into users
        $userData = [
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'pelanggan',
            'pelanggan_id' => $pelangganId,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];
        $db->table('users')->insert($userData);
        $newUserId = $db->insertID();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat pendaftaran.');
        }

        // Auto-login
        $sessionData = [
            'id'           => $newUserId,
            'username'     => $userData['username'],
            'role'         => 'pelanggan',
            'pelanggan_id' => $pelangganId,
            'isLoggedIn'   => true,
        ];
        session()->set($sessionData);

        return redirect()->to('/customer/dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
