<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Transaksi extends Migration
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
            'sub_total' => [
                'type'       => 'INT',
            ],
            'jumlah' => [
                'type' => 'INT',
            ],
            'total' => [
                'type' => 'INT',
            ],
            'id_barang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'variasi' => [ 
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'id_user' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'nomortelp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'alamat' => [
                'type'           => 'TEXT',
            ],
            'bukti_pembayaran' => [
                'type'           => 'VARCHAR',
                'constraint' => 100,
            ],
            'options' => [
                'type'           => 'TEXT',
            ],
            'verifikasi' => [  
                'constraint' => ['1', '2', '3', '4', '5'],
                'default' => '1',
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
        
        // Add the primary key
        $this->forge->addKey('id', true);
        $this->forge->createTable('transaksi', true);

        $this->db->query('ALTER TABLE `transaksi` ADD CONSTRAINT `my_fk_transaksiuser` FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `transaksi` ADD CONSTRAINT `my_fk_transaksibarang` FOREIGN KEY (`id_barang`) REFERENCES `barang`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
