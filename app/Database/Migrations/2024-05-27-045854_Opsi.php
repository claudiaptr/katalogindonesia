<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Opsi extends Migration
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
            'nama_variasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'harga' => [
                'type'       => 'INT',
            ],
            'id_variasi' => [
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
        $this->forge->createTable('opsi');
        $this->db->query('ALTER TABLE `opsi` ADD CONSTRAINT `my_fk_opsi` FOREIGN KEY (`id_variasi`) REFERENCES `variasi`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
       
    }

    public function down()
    {
        $this->forge->dropTable('opsi');
    }
}
