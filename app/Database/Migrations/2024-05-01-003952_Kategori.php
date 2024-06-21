<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Kategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kode_jenis' => [
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
        $this->forge->addKey('kode_jenis', true);
        $this->forge->createTable('kategori');
        // $this->forge->addForeignKey('kode_jenis', 'kategori', 'kode_jenis', 'CASCADE', 'CASCADE');
        // $this->db->query('ALTER TABLE `kategori` ADD CONSTRAINT `` FOREIGN KEY (``) REFERENCES ``(``) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    public function down()
    {
        $this->forge->dropTable('kategori');
    }
}
