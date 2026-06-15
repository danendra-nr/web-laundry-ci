<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username'   => 'admin',
            'password'   => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->table('pengaturan')->insert([
            'nama_laundry' => 'Mulia Laundry',
            'logo'         => null,
            'whatsapp'     => '081234567890',
            'alamat'       => 'Jl. Raya No. 123, Jakarta',
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ]);

        $layanan = [
            [
                'kode_layanan'  => 'CK',
                'nama_layanan'  => 'Cuci Kering',
                'harga_per_kg'  => 6000.00,
                'estimasi_hari' => 2,
                'status'        => 'Aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_layanan'  => 'CS',
                'nama_layanan'  => 'Cuci Setrika',
                'harga_per_kg'  => 8000.00,
                'estimasi_hari' => 2,
                'status'        => 'Aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_layanan'  => 'CKS',
                'nama_layanan'  => 'Cuci Kering Setrika',
                'harga_per_kg'  => 9000.00,
                'estimasi_hari' => 3,
                'status'        => 'Aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'kode_layanan'  => 'EXP',
                'nama_layanan'  => 'Express (1 Hari)',
                'harga_per_kg'  => 15000.00,
                'estimasi_hari' => 1,
                'status'        => 'Aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($layanan as $l) {
            $this->db->table('layanan_laundry')->insert($l);
        }

        $pelanggan = [
            [
                'nama'       => 'Rian Hidayat',
                'no_hp'      => '081234567891',
                'alamat'     => 'Jl. Kemuning No. 12, Jakarta',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Siti Rahma',
                'no_hp'      => '085712345678',
                'alamat'     => 'Jl. Melati No. 45, Bandung',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Ahmad Fauzi',
                'no_hp'      => '089987654321',
                'alamat'     => 'Jl. Mawar No. 7, Surabaya',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama'       => 'Dewi Lestari',
                'no_hp'      => '082133445566',
                'alamat'     => 'Jl. Dahlia No. 19, Medan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($pelanggan as $p) {
            $this->db->table('pelanggan')->insert($p);
        }

        $pelangganIds = $this->db->table('pelanggan')->select('id')->get()->getResultArray();
        $layananIds = $this->db->table('layanan_laundry')->select('id, harga_per_kg, estimasi_hari')->get()->getResultArray();

        $transaksi = [
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-6 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[2]['id'],
                'layanan_id'      => $layananIds[3]['id'],
                'berat_kg'        => 3.5,
                'harga_per_kg'    => $layananIds[3]['harga_per_kg'],
                'total_harga'     => 3.5 * $layananIds[3]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-6 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-6 days + ' . $layananIds[3]['estimasi_hari'] . ' days')),
                'status'          => 'Diambil',
                'catatan'         => 'Selesai tepat waktu',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-6 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-5 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[1]['id'],
                'layanan_id'      => $layananIds[0]['id'],
                'berat_kg'        => 4.5,
                'harga_per_kg'    => $layananIds[0]['harga_per_kg'],
                'total_harga'     => 4.5 * $layananIds[0]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-5 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-5 days + ' . $layananIds[0]['estimasi_hari'] . ' days')),
                'status'          => 'Diambil',
                'catatan'         => '',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-4 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[0]['id'],
                'layanan_id'      => $layananIds[1]['id'],
                'berat_kg'        => 6.0,
                'harga_per_kg'    => $layananIds[1]['harga_per_kg'],
                'total_harga'     => 6.0 * $layananIds[1]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-4 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-4 days + ' . $layananIds[1]['estimasi_hari'] . ' days')),
                'status'          => 'Selesai',
                'catatan'         => 'Pakaian rapikan',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-3 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[0]['id'],
                'layanan_id'      => $layananIds[0]['id'],
                'berat_kg'        => 5.0,
                'harga_per_kg'    => $layananIds[0]['harga_per_kg'],
                'total_harga'     => 5.0 * $layananIds[0]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-3 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-3 days + ' . $layananIds[0]['estimasi_hari'] . ' days')),
                'status'          => 'Selesai',
                'catatan'         => '',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-2 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[1]['id'],
                'layanan_id'      => $layananIds[1]['id'],
                'berat_kg'        => 3.0,
                'harga_per_kg'    => $layananIds[1]['harga_per_kg'],
                'total_harga'     => 3.0 * $layananIds[1]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-2 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-2 days + ' . $layananIds[1]['estimasi_hari'] . ' days')),
                'status'          => 'Diproses',
                'catatan'         => 'Jangan pakai pewangi menyengat',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd', strtotime('-1 days')) . '-0001',
                'pelanggan_id'    => $pelangganIds[2]['id'],
                'layanan_id'      => $layananIds[2]['id'],
                'berat_kg'        => 4.0,
                'harga_per_kg'    => $layananIds[2]['harga_per_kg'],
                'total_harga'     => 4.0 * $layananIds[2]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d', strtotime('-1 days')),
                'tanggal_selesai' => date('Y-m-d', strtotime('-1 days + ' . $layananIds[2]['estimasi_hari'] . ' days')),
                'status'          => 'Menunggu',
                'catatan'         => 'Pisahkan baju putih',
                'created_at'      => date('Y-m-d H:i:s', strtotime('-1 days')),
                'updated_at'      => date('Y-m-d H:i:s', strtotime('-1 days')),
            ],
            [
                'invoice'         => 'INV-' . date('Ymd') . '-0001',
                'pelanggan_id'    => $pelangganIds[3]['id'],
                'layanan_id'      => $layananIds[3]['id'],
                'berat_kg'        => 2.0,
                'harga_per_kg'    => $layananIds[3]['harga_per_kg'],
                'total_harga'     => 2.0 * $layananIds[3]['harga_per_kg'],
                'tanggal_masuk'   => date('Y-m-d'),
                'tanggal_selesai' => date('Y-m-d', strtotime('today + ' . $layananIds[3]['estimasi_hari'] . ' days')),
                'status'          => 'Menunggu',
                'catatan'         => 'Baju seragam sekolah',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($transaksi as $t) {
            $this->db->table('transaksi_laundry')->insert($t);
        }
    }
}
