<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\PengaturanModel;

class Home extends BaseController
{
    public function index(): string
    {
        $layananModel = new LayananModel();
        $pengaturanModel = new PengaturanModel();

        // Ambil data layanan aktif
        $layanan = $layananModel->where('status', 'Aktif')->findAll();
        if (empty($layanan)) {
            $layanan = $layananModel->findAll();
        }

        // Ambil data profil laundry
        $pengaturan = $pengaturanModel->first();

        return view('landing', [
            'layanan'    => $layanan,
            'pengaturan' => $pengaturan,
        ]);
    }
}
