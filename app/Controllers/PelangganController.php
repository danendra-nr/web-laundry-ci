<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use App\Models\PengaturanModel;

class PelangganController extends BaseController
{
    public function index()
    {
        $pelangganModel = new PelangganModel();
        $search = $this->request->getVar('search') ?? '';

        if (!empty($search)) {
            $pelangganModel->groupStart()
                           ->like('nama', $search)
                           ->orLike('no_hp', $search)
                           ->orLike('alamat', $search)
                           ->groupEnd();
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('pelanggan/index', [
            'pelanggan'  => $pelangganModel->paginate(10, 'pelanggan'),
            'pager'      => $pelangganModel->pager,
            'search'     => $search,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function create()
    {
        $pengaturan = (new PengaturanModel())->first();
        return view('pelanggan/create', ['pengaturan' => $pengaturan]);
    }

    public function store()
    {
        $rules = [
            'nama'  => 'required',
            'no_hp' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pelangganModel = new PelangganModel();
        $pelangganModel->save([
            'nama'   => $this->request->getPost('nama'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelangganModel = new PelangganModel();
        $pelanggan = $pelangganModel->find($id);

        if (!$pelanggan) {
            return redirect()->to('/pelanggan')->with('error', 'Pelanggan tidak ditemukan.');
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('pelanggan/edit', [
            'pelanggan'  => $pelanggan,
            'pengaturan' => $pengaturan
        ]);
    }

    public function update($id)
    {
        $rules = [
            'nama'  => 'required',
            'no_hp' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $pelangganModel = new PelangganModel();
        $pelangganModel->update($id, [
            'nama'   => $this->request->getPost('nama'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil diupdate.');
    }

    public function delete($id)
    {
        $pelangganModel = new PelangganModel();
        $pelangganModel->delete($id);

        return redirect()->to('/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
