<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Variasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
               
            ],
            'nama_variasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'harga' => [
                'type'       => 'INT',
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
        $this->forge->createTable('variasi');
        $this->db->query('ALTER TABLE `variasi` ADD CONSTRAINT `my_fk_variasi` FOREIGN KEY (`id_barang`) REFERENCES `barang`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
       
    }

    public function down()
    {
        $this->forge->dropTable('variasi');
    }
}
