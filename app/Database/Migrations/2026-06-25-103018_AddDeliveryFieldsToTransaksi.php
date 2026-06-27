<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeliveryFieldsToTransaksi extends Migration
{
    public function up()
    {
        $fields = [
            'opsi_pengiriman' => [
                'type'       => 'ENUM',
                'constraint' => ['Kirim Sendiri', 'Jemput Saja', 'Antar Saja', 'Jemput dan Antar'],
                'default'    => 'Kirim Sendiri',
                'after'      => 'catatan',
            ],
            'alamat_pengiriman' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'opsi_pengiriman',
            ],
            'status_pengiriman' => [
                'type'       => 'ENUM',
                'constraint' => ['None', 'Menunggu Penjemputan', 'Dalam Penjemputan', 'Selesai Dijemput', 'Menunggu Pengantaran', 'Dalam Pengantaran', 'Selesai Diantar'],
                'default'    => 'None',
                'after'      => 'alamat_pengiriman',
            ],
        ];
        $this->forge->addColumn('transaksi_laundry', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksi_laundry', 'opsi_pengiriman');
        $this->forge->dropColumn('transaksi_laundry', 'alamat_pengiriman');
        $this->forge->dropColumn('transaksi_laundry', 'status_pengiriman');
    }
}
