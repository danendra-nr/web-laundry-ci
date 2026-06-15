<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\UserModel;

class PengaturanController extends BaseController
{
    public function index()
    {
        $pengaturanModel = new PengaturanModel();
        $pengaturan = $pengaturanModel->first();

        return view('pengaturan/index', [
            'pengaturan' => $pengaturan
        ]);
    }

    public function update()
    {
        $rules = [
            'nama_laundry' => 'required',
            'whatsapp'     => 'required',
            'alamat'       => 'required',
            'logo'         => 'is_image[logo]|max_size[logo,2048]|ext_in[logo,png,jpg,jpeg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pengaturanModel = new PengaturanModel();
        $pengaturan = $pengaturanModel->first();
        $id = $pengaturan['id'];

        $data = [
            'nama_laundry' => $this->request->getPost('nama_laundry'),
            'whatsapp'     => $this->request->getPost('whatsapp'),
            'alamat'       => $this->request->getPost('alamat'),
        ];

        $logoFile = $this->request->getFile('logo');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            // Delete old logo if it exists
            if (!empty($pengaturan['logo']) && file_exists(FCPATH . 'uploads/logo/' . $pengaturan['logo'])) {
                unlink(FCPATH . 'uploads/logo/' . $pengaturan['logo']);
            }

            $newName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/logo/', $newName);
            $data['logo'] = $newName;
        }

        $pengaturanModel->update($id, $data);

        return redirect()->to('/pengaturan')->with('success', 'Profil laundry berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $rules = [
            'username' => 'required',
        ];

        $passwordBaru = $this->request->getPost('password_baru');

        if (!empty($passwordBaru)) {
            $rules['password_baru']    = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[password_baru]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = session()->get('id');
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
        ];

        if (!empty($passwordBaru)) {
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);

        // Update session username as well
        session()->set('username', $this->request->getPost('username'));

        return redirect()->to('/pengaturan')->with('success', 'Akun pengguna berhasil diperbarui.');
    }
}
