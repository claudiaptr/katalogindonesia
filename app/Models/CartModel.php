<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = 'cart';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['id_user', 'id_barang', 'created_at', 'updated_at'];

    protected $useTimestamps = true; // Mengaktifkan penggunaan timestamps
    protected $dateFormat    = 'datetime'; // Format waktu
    protected $createdField  = 'created_at'; // Nama field untuk created timestamp
    protected $updatedField  = 'updated_at'; // Nama field untuk updated timestamp


    // Method to calculate the total items for a specific user
    public function totalItemsByUser($userId)
    {
    return $this->where('id_user', $userId)
    ->countAllResults();  // Counts all cart entries for the user
    }

    // Menambahkan fungsi untuk mendapatkan cart berdasarkan user
    public function getCartByUserId($userId)
    {
        return $this->where('id_user', $userId)->findAll();
    }

    // Menambahkan fungsi untuk menambah item ke cart
    public function addToCart($data)
    {
        return $this->insert($data);
    }

    // Menambahkan fungsi untuk menghapus item dari cart
    public function removeFromCart($id)
    {
        return $this->delete($id);
    }

    // Menambahkan fungsi untuk mengupdate item di cart
    public function updateCart($id, $data)
    {
        return $this->update($id, $data);
    }
}
