<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_barang', 'jumlah_barang', 'created_at', 'updated_at'];

    public function getWishlistByUser($userId)
    {
        return $this->select('wishlist.*, barang.judul_barang, barang.harga_barang, wishlist.jumlah_barang')
                    ->join('barang', 'barang.id = wishlist.id_barang')
                    ->where('wishlist.id_user', $userId)
                    ->findAll();
    }

    public function addToWishlist($data)
    {
        if (empty($data['id_user']) || empty($data['id_barang'])) {
            return false; // Atau throw exception sesuai kebutuhan
        }
        return $this->insert($data);
    }

    public function isInWishlist($userId, $productId)
    {
        return $this->where(['id_user' => $userId, 'id_barang' => $productId])->first() !== null;
    }

    public function removeFromWishlist($id)
    {
        return $this->delete($id);
    }
}
