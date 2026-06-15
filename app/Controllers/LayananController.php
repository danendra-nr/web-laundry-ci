<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PengaturanModel;

class LayananController extends BaseController
{
    public function index()
    {
        $layananModel = new LayananModel();
        $search = $this->request->getVar('search') ?? '';

        if (!empty($search)) {
            $layananModel->groupStart()
                         ->like('kode_layanan', $search)
                         ->orLike('nama_layanan', $search)
                         ->groupEnd();
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('layanan/index', [
            'layanan'    => $layananModel->paginate(10, 'layanan'),
            'pager'      => $layananModel->pager,
            'search'     => $search,
            'pengaturan' => $pengaturan,
        ]);
    }

    public function create()
    {
        $pengaturan = (new PengaturanModel())->first();
        return view('layanan/create', ['pengaturan' => $pengaturan]);
    }

    public function store()
    {
        $rules = [
            'kode_layanan'  => 'required|is_unique[layanan_laundry.kode_layanan]',
            'nama_layanan'  => 'required',
            'harga_per_kg'  => 'required|numeric',
            'estimasi_hari' => 'required|numeric',
            'status'        => 'required|in_list[Aktif,Nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $layananModel = new LayananModel();
        $layananModel->save([
            'kode_layanan'  => strtoupper($this->request->getPost('kode_layanan')),
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'harga_per_kg'  => $this->request->getPost('harga_per_kg'),
            'estimasi_hari' => $this->request->getPost('estimasi_hari'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/layanan')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $layananModel = new LayananModel();
        $layanan = $layananModel->find($id);

        if (!$layanan) {
            return redirect()->to('/layanan')->with('error', 'Layanan tidak ditemukan.');
        }

        $pengaturan = (new PengaturanModel())->first();

        return view('layanan/edit', [
            'layanan'    => $layanan,
            'pengaturan' => $pengaturan
        ]);
    }

    public function update($id)
    {
        $rules = [
            'kode_layanan'  => "required|is_unique[layanan_laundry.kode_layanan,id,{$id}]",
            'nama_layanan'  => 'required',
            'harga_per_kg'  => 'required|numeric',
            'estimasi_hari' => 'required|numeric',
            'status'        => 'required|in_list[Aktif,Nonaktif]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $layananModel = new LayananModel();
        $layananModel->update($id, [
            'kode_layanan'  => strtoupper($this->request->getPost('kode_layanan')),
            'nama_layanan'  => $this->request->getPost('nama_layanan'),
            'harga_per_kg'  => $this->request->getPost('harga_per_kg'),
            'estimasi_hari' => $this->request->getPost('estimasi_hari'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/layanan')->with('success', 'Layanan berhasil diupdate.');
    }

    public function delete($id)
    {
        $layananModel = new LayananModel();
        $layananModel->delete($id);

        return redirect()->to('/layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}
