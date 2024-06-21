<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Barang extends Migration
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
            'foto_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi_barang' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'id_kategori_barang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'id_sub_kategori_barang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'judul_barang' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'harga_barang' => [
                'type' => 'INT',
            ],
            'jumlah_barang' => [
                'type' => 'INT',
            ],
            'pemilik' => [
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
        $this->forge->createTable('barang');
        $this->db->query('ALTER TABLE `barang` ADD CONSTRAINT `my_fk_pmilik` FOREIGN KEY (`pemilik`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `barang` ADD CONSTRAINT `my_fk_barang_ketegori` FOREIGN KEY (`id_kategori_barang`) REFERENCES `kategori`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `barang` ADD CONSTRAINT `my_fk_barang_sub_ketegori` FOREIGN KEY (`id_sub_kategori_barang`) REFERENCES `sub_kategori`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
