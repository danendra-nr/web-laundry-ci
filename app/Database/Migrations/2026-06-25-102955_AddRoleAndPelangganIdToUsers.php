<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleAndPelangganIdToUsers extends Migration
{
    public function up()
    {
        $fields = [
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'admin',
                'after'      => 'password',
            ],
            'pelanggan_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'role',
            ],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role');
        $this->forge->dropColumn('users', 'pelanggan_id');
    }
}
