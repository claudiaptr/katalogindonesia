<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDiskonToBarang extends Migration
{
    public function up()
    {
        $this->forge->addColumn('barang', [
            'diskon' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,   
            ],
            'harga_setelah_diskon' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2', 
                'null'       => true,   
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('barang', ['diskon', 'harga_setelah_diskon']);
    }
}
