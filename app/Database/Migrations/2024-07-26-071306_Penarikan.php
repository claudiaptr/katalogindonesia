<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Penarikan extends Migration
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
            'jumlah_penarikan' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'bank' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Tambahkan constraint panjang
            ],
            'username_bank' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Tambahkan constraint panjang
            ],
            'id_user' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
            ],
            'nomor_rekening' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Tambahkan constraint panjang
            ],
            'bukti_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'verifikasi_penarikan' => [
                'type'       => 'ENUM',
                'constraint' => ['1', '2', '3'],
                'default'    => '1', // Default value harus berupa string karena ENUM
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new RawSql('CURRENT_TIMESTAMP'), // Menambahkan on update current timestamp
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penarikan');
    }

    public function down()
    {
        $this->forge->dropTable('penarikan');
    }
}

