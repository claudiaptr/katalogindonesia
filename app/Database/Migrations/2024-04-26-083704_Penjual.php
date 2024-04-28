<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjual extends Migration
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
            'nama_toko' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id', 'CASCADE', 'CASCADE', 'my_fk_penjual');
        $this->forge->createTable('penjual');
        
    }

    public function down()
    {
        $this->forge->dropTable('penjual');
    }
}
