<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_barang', 'created_at', 'updated_at'];

    public function getWishlistByUser($userId)
{
    return $this->select('wishlist.*, barang.foto_barang, barang.judul_barang, barang.harga_barang, barang.pemilik') // Pastikan ada kolom yang sesuai di tabel barang
                ->join('barang', 'barang.id = wishlist.id_barang') // Gabungkan tabel barang
                ->where('wishlist.id_user', $userId)
                ->findAll();
}
    public function addToWishlist($userId, $barangId)
    {
        // Ambil informasi barang berdasarkan ID
        $barang = $this->db->table('barang')->select('pemilik')->where('id', $barangId)->get()->getRow();

        // Ambil nama toko berdasarkan pemilik
        if ($barang) {
            $pemilikId = $barang->pemilik;
            $toko = $this->db->table('user')->select('nama_toko')->where('id', $pemilikId)->get()->getRow();
            
            $data = [
                'id_user' => $userId,
                'id_barang' => $barangId,
                'nama_toko' => $toko ? $toko->nama_toko : null, // Mengisi nama_toko
            ];
            
            return $this->db->table('wishlist')->insert($data);
        }

        return false;
    }

    public function isInWishlist($userId, $productId)
    {
        return $this->where(['id_user' => $userId, 'id_barang' => $productId])->first() !== null;
    }


    public function delete_wishlist($id)
{
    $wishlistModel = new WishlistModel();
    
    // Pastikan hanya item wishlist milik user yang dihapus
    $wishlistModel->where('id', $id)->delete();

    return redirect()->to('user/wishlist')->with('message', 'Produk berhasil dihapus dari wishlist!');
}

}
