<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'penjual',
                'email'    => 'penjual@gmail.com',
                'password' => password_hash('penjual123', PASSWORD_DEFAULT),
                'no_hp'    => '087616161',
                'nama_toko' => 'Toko Penjual',
                'alamat'   => 'Bali',
                'level'    => '2',
            ],
            [
                'username' => 'pembeli',
                'email'    => 'pembeli@gmail.com',
                'password' => password_hash('pembeli123', PASSWORD_DEFAULT),
                'no_hp'    => '087616162',
                'nama_toko' => 'Toko Pembeli',
                'alamat'   => 'Jakarta',
                'level'    => '3',
            ],
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'no_hp'    => '087616163',
                'nama_toko' => 'Toko Admin',
                'alamat'   => 'Surabaya',
                'level'    => '1',
            ],
        ];
        $alamat = [
            [
                'provinsi' => 'Bali',
                'kabupaten'    => 'Tabanan',
                'kecamatan' => 'Baturiti',
                'kelurahan'    => 'Candikuning',
                'user' => 1,
               
            ],
        ];

        // Inserting multiple rows using Query Builder
        $this->db->table('user')->insertBatch($data);
        $this->db->table('alamat_toko')->insertBatch($alamat);
    }
}
