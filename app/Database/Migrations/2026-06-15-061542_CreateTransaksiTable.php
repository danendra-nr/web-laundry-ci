<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'invoice' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'pelanggan_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'layanan_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'berat_kg' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'harga_per_kg' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',
            ],
            'tanggal_selesai' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Menunggu', 'Diproses', 'Selesai', 'Diambil'],
                'default'    => 'Menunggu',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('transaksi_laundry');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_laundry');
    }
}
