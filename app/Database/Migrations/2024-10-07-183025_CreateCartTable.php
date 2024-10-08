<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Cart extends Migration
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
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
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
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('cart');

        // Menambahkan foreign key constraints
        $this->db->query('ALTER TABLE `cart` ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `cart` ADD CONSTRAINT `fk_cart_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        // Hapus foreign key sebelum menghapus tabel
        $this->db->query('ALTER TABLE `cart` DROP FOREIGN KEY `fk_cart_user`');
        $this->db->query('ALTER TABLE `cart` DROP FOREIGN KEY `fk_cart_barang`');
        
        $this->forge->dropTable('cart');
    }
}
