<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class FotoBarang extends Migration
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
            'foto_barang_lain' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_barang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,

            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('foto_barang');
        $this->forge->addForeignKey('id_barang', 'barang', 'id', 'CASCADE', 'CASCADE', 'my_fk_foto_barang');
    }

    public function down()
    {
        $this->forge->dropTable('foto_barang');
    }
}
