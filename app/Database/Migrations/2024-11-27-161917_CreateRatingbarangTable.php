<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRatingbarangTable extends Migration
{
    public function up()
    {
        // Membuat field untuk tabel ratingbarang
        $this->forge->addField([
            'idratingbarang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'idbarang' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'rating' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'comment' => [
                'type' => 'TEXT',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'iduser' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'default'    => 'CURRENT_TIMESTAMP',
            ],
        ]);

        // Menambahkan primary key pada kolom 'idratingbarang'
        $this->forge->addPrimaryKey('idratingbarang');

        // Membuat tabel ratingbarang
        $this->forge->createTable('ratingbarang');

        // Menambahkan foreign key ke tabel barang dan user
        $this->db->query('
            ALTER TABLE `ratingbarang` 
            ADD CONSTRAINT `fk_ratingbarang_barang` 
            FOREIGN KEY (`idbarang`) REFERENCES `barang`(`id`) 
            ON DELETE CASCADE ON UPDATE CASCADE
        ');

        $this->db->query('
            ALTER TABLE `ratingbarang` 
            ADD CONSTRAINT `fk_ratingbarang_user` 
            FOREIGN KEY (`iduser`) REFERENCES `user`(`id`) 
            ON DELETE CASCADE ON UPDATE CASCADE
        ');

    }

    public function down()
    {
        // Hapus foreign key sebelum menghapus tabel
        $this->db->query('ALTER TABLE `ratingbarang` DROP FOREIGN KEY `fk_ratingbarang_barang`');
        $this->db->query('ALTER TABLE `ratingbarang` DROP FOREIGN KEY `fk_ratingbarang_user`');

        // Hapus tabel ratingbarang
        $this->forge->dropTable('ratingbarang');
    }
}
