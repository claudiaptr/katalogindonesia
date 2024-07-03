<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AlamatToko extends Migration
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
            'provinsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'user' => [
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
        $this->forge->createTable('alamat_toko');
        $this->db->query('ALTER TABLE `alamat_toko` ADD CONSTRAINT `my_fk_toko_alamat` FOREIGN KEY (`user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('alamat_toko');
    }
}
