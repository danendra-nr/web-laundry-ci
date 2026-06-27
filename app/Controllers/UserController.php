<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PengaturanModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $search = $this->request->getVar('search') ?? '';

        $builder = $userModel->select('users.*, pelanggan.nama as nama_pelanggan')
                             ->join('pelanggan', 'pelanggan.id = users.pelanggan_id', 'left');

        if (!empty($search)) {
            $builder->like('username', $search);
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('user/index', [
            'users'      => $builder->paginate(10, 'user'),
            'pager'      => $userModel->pager,
            'search'     => $search,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function create()
    {
        $pengaturan = (new PengaturanModel())->first();
        $pelanggan = (new \App\Models\PelangganModel())->findAll();
        
        return view('user/create', [
            'pengaturan' => $pengaturan,
            'pelanggan'  => $pelanggan
        ]);
    }

    public function store()
    {
        $rules = [
            'username'         => 'required|is_unique[users.username]|min_length[3]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
            'role'             => 'required|in_list[admin,pelanggan]',
            'pelanggan_id'     => 'permit_empty',
        ];

        if ($this->request->getPost('role') === 'pelanggan') {
            $rules['pelanggan_id'] = 'required|numeric';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => $this->request->getPost('role'),
            'pelanggan_id' => $this->request->getPost('role') === 'pelanggan' ? $this->request->getPost('pelanggan_id') : null,
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }

        $pengaturan = (new PengaturanModel())->first();
        $pelanggan = (new \App\Models\PelangganModel())->findAll();

        return view('user/edit', [
            'user'       => $user,
            'pengaturan' => $pengaturan,
            'pelanggan'  => $pelanggan
        ]);
    }

    public function update($id)
    {
        $rules = [
            'username' => "required|is_unique[users.username,id,{$id}]|min_length[3]",
            'role'     => 'required|in_list[admin,pelanggan]',
        ];

        if ($this->request->getPost('role') === 'pelanggan') {
            $rules['pelanggan_id'] = 'required|numeric';
        }

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password']         = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $data = [
            'username'     => $this->request->getPost('username'),
            'role'         => $this->request->getPost('role'),
            'pelanggan_id' => $this->request->getPost('role') === 'pelanggan' ? $this->request->getPost('pelanggan_id') : null,
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/user')->with('success', 'User berhasil diupdate.');
    }

    public function delete($id)
    {
        if ($id == session()->get('id')) {
            return redirect()->to('/user')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/user')->with('success', 'User berhasil dihapus.');
    }
}
