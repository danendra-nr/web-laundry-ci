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

        if (!empty($search)) {
            $userModel->like('username', $search);
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('user/index', [
            'users'      => $userModel->paginate(10, 'user'),
            'pager'      => $userModel->pager,
            'search'     => $search,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function create()
    {
        $pengaturan = (new PengaturanModel())->first();
        return view('user/create', ['pengaturan' => $pengaturan]);
    }

    public function store()
    {
        $rules = [
            'username'         => 'required|is_unique[users.username]|min_length[3]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
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

        return view('user/edit', [
            'user'       => $user,
            'pengaturan' => $pengaturan
        ]);
    }

    public function update($id)
    {
        $rules = [
            'username' => "required|is_unique[users.username,id,{$id}]|min_length[3]",
        ];

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
            'username' => $this->request->getPost('username'),
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
