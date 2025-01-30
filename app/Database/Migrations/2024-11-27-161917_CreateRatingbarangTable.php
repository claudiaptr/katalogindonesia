<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRatingBarangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idratingbarang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'idbarang' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'rating' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'comment' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
            ],
            'iduser' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'default'    => 'Non Active',
            ],
            'foto' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idratingbarang', true);
        $this->forge->createTable('ratingbarang');
    }

    public function down()
    {
        $this->forge->dropTable('ratingbarang');
    }
}
