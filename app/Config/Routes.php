<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Admin

// Routes for Admin
$routes->get('/admin/auth/login', 'AdminController::login');
$routes->post('/admin/auth/cek_login', 'AdminController::cek_login');
$routes->get('/admin/auth/register', 'AdminController::register');
$routes->post('/admin/auth/save_register', 'AdminController::save_register');
$routes->get('/admin/auth/logout', 'AdminController::logout');

$routes->get('/admin/dashboard', 'Home::index');
$routes->get('/admin/view_iklan_carausel', 'AdminController::view_iklan_carausel');
$routes->post('/admin/store_iklan_carausel', 'AdminController::store_iklan_carausel');
$routes->get('/admin/add_iklan_carausel', 'AdminController::add_iklan_carausel');
$routes->delete('/admin/delete_iklan_carausel/(:num)', 'AdminController::delete_iklan_carusel/$1');
$routes->get('/admin/edit_iklan_carausel/(:any)', 'AdminController::edit_iklan_carausel/$1');
$routes->post('/admin/update_iklan_carausel/(:num)', 'AdminController::update_iklan_carausel/$1');


$routes->get('/admin/view_iklan_tetap', 'IklanController::view_iklan_tetap');
$routes->post('/admin/store_iklan_tetap', 'IklanController::store_iklan_tetap');
$routes->get('/admin/add_iklan_tetap', 'IklanController::add_iklan_tetap');
$routes->delete('/admin/delete_iklan_tetap/(:num)', 'IklanController::delete_iklan_tetap/$1');

$routes->get('/admin/edit_iklan_tetap/(:any)', 'IklanController::edit_iklan_tetap/$1');
$routes->post('/admin/update_iklan_tetap/(:num)', 'IklanController::update_iklan_tetap/$1');
$routes->get('/admin/view_kategori', 'AdminController::view_kategori');
$routes->get('/admin/add_kategori', 'AdminController::add_kategori');
$routes->get('/admin/edit_kategori/(:any)', 'AdminController::edit_kategori/$1');
$routes->post('/admin/update_kategori/(:num)', 'AdminController::update_kategori/$1');
$routes->delete('/admin/delete_kategori/(:num)', 'AdminController::delete_kategori/$1');

$routes->post('/admin/store_kategori', 'AdminController::store_kategori');
$routes->get('/admin/view_sub_kategori', 'AdminController::view_sub_kategori');
$routes->get('/admin/add_sub_kategori', 'AdminController::add_sub_kategori');
$routes->post('/admin/store_sub_kategori', 'AdminController::store_sub_kategori');
$routes->get('/admin/edit_sub_kategori/(:any)', 'AdminController::edit_sub_kategori/$1');
$routes->post('/admin/update_sub_kategori/(:num)', 'AdminController::update_sub_kategori/$1');
$routes->delete('/admin/delete_sub_kategori/(:num)', 'AdminController::delete_sub_kategori/$1');

$routes->get('/admin/belum_verifikasi', 'AdminController::view_belum_verifikasi');
$routes->get('/admin/detail_barang/(:num)', 'AdminController::detail_barang/$1');
$routes->put('/admin/verifikasi_barang/(:num)', 'AdminController::verifikasi_barang/$1');
$routes->put('/admin/tolak_verifikasi_barang/(:num)', 'AdminController::tolak_verifikasi_barang/$1');
$routes->get('/admin/sudah_verifikasi', 'AdminController::view_sudah_verifikasi');
$routes->get('/admin/tolak_verifikasi', 'AdminController::view_tolak_verifikasi');

$routes->get('/admin/detail_pembayaran/(:num)', 'AdminController::detail_pembayaran/$1');
$routes->get('/admin/verifikasi_blm_pembayaran', 'AdminController::verifikasi_blm_pembayaran');
$routes->put('/admin/verifikasi_pembayaran/(:num)', 'AdminController::verifikasi_pembayaran/$1');
$routes->get('/admin/verifikasi_sdh_pembayaran', 'AdminController::view_sudah_verifikasi_pembayaran');
$routes->get('/admin/verifikasi_tlk_pembayaran', 'AdminController::view_tolak_verifikasi_pembayaran');
$routes->put('/admin/tolak_verifikasi_pembayaran/(:num)', 'AdminController::tolak_verifikasi_pembayaran/$1');

$routes->get('/admin/verifikasi_blm_penarikan', 'AdminController::view_blm_penarikan');
$routes->get('/admin/verifikasi_penarikan/(:num)', 'AdminController::verifikasi_penarikan/$1');
$routes->post('/admin/store_verifikasi_penarikan/(:num)', 'AdminController::store_verifikasi_penarikan/$1');
$routes->get('/admin/edit_verifikasi_penarikan/(:num)', 'AdminController::edit_verifikasi_penarikan/$1');
$routes->post('/admin/update_verifikasi_penarikan/(:num)', 'AdminController::update_verifikasi_penarikan/$1');
$routes->get('/admin/detail_penarikan/(:num)', 'AdminController::detail_penarikan/$1');
$routes->put('/admin/tolak_verifikasi_penarikan/(:num)', 'AdminController::tolak_verifikasi_penarikan/$1');

$routes->get('/admin/view_transfer', 'AdminController::view_transfer');
$routes->get('/admin/add_transfer/(:num)', 'AdminController::add_transfer/$1');
$routes->post('/admin/store_saldo/(:num)', 'AdminController::store_transfer/$1');

$routes->get('admin/data_pengguna', 'AdminController::dataPengguna'); // Halaman daftar pengguna
$routes->get('admin/data_pengguna/edit/(:num)', 'AdminController::editDataPengguna/$1'); // Halaman edit pengguna berdasarkan ID
$routes->post('admin/data_pengguna/update', 'AdminController::updateDataPengguna'); // Proses update data pengguna

$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');
$routes->get('/auth/register_google', 'Auth::register_google');


$routes->get('user/detail/(:num)', 'UserController::detail/$1');

$routes->get('/user/contact', 'UserController::contact');
$routes->get('/checkout', 'UserController::checkout');
$routes->get('/cart', 'UserController::cart');
$routes->post('/add_chart', 'UserController::add_chart');
$routes->get('/delete_chart', 'UserController::delete_chart');
$routes->get('/hapus_semua', 'UserController::hapus_semua');

$routes->get('/sales/home', 'SalesController::home');


//User
$routes->get('/user/home', 'UserController::home');
$routes->get('/user/shop', 'UserController::shop');
$routes->get('/', 'UserController::home');
$routes->get('/user/jasa', 'UserController::jasa');
$routes->get('/user/contact', 'EmailController::index');
$routes->get('/tracking', 'UserController::tracking');
$routes->post('user/filter', 'UserController::filter_toko');
$routes->get('myaccount', 'UserController::myAccount');

$routes->get('user/hasil_pencarian', 'UserController::subkategori');


$routes->post('/user/harga_barang', 'UserController::harga_barang');
$routes->post('/transaksii', 'UserController::transaksi');
$routes->get('/user/delete_chart/(:any)', 'UserController::delete_cart/$1');


$routes->get('/user/cek', 'UserController::cek');
$routes->match(['get', 'post'], 'email', 'SendEmail::index');
$routes->get('/user/email/send', 'EmailController::send');


//Logout
$routes->add('/logout', 'Auth::logout');

// penjual
$routes->get('daftar/penjual', 'SalesController::daftar_penjual');
$routes->post('store/penjual', 'SalesController::add_penjual');
$routes->get('/sales/home', 'SalesController::home');
$routes->get('/sales/barang/view_barang',  'SalesController::view_barang');
$routes->get('/sales/view_diskon', 'SalesController::view_diskon');
$routes->get('/sales/view_pesanan', 'SalesController::view_pesanan');
$routes->get('/sales/view_pesanan', 'SalesController::view_pesanan');
$routes->get('/sales/kemas_pesanan', 'SalesController::kemas_pesanan');
$routes->get('/sales/kirim_pesanan', 'SalesController::kirim_pesanan');
$routes->get('/sales/selesai_pesanan', 'SalesController::selesai_pesanan');
$routes->post('/sales/kemas/(:any)', 'SalesController::kemas/$1');
$routes->post('/sales/kirim/(:any)', 'SalesController::kirim/$1');
$routes->post('/sales/selesai/(:any)', 'SalesController::selesai/$1');
$routes->get('/sales/barang/add_barang',  'SalesController::add_barang');
$routes->get('/sales/jasa/view_jasa',  'SalesController::view_jasa');
$routes->get('/sales/jasa/edit_jasa/(:num)',  'SalesController::edit_jasa/$1');
$routes->post('/sales/jasa/update_jasa/(:num)',  'SalesController::update_jasa/$1');
$routes->get('/sales/jasa/add_jasa',  'SalesController::add_jasa');
$routes->post('/sales/jasa/store_jasa',  'SalesController::store_jasa');
$routes->delete('/sales/jasa/delete_jasa/(:num)',  'SalesController::delete_jasa/$1');
$routes->get('/sales/add_diskon', 'SalesController::add_diskon');
$routes->get('/sales/barang/edit_barang/(:num)',  'SalesController::edit_barang/$1');
$routes->post('/sales/update_barang/(:num)',  'SalesController::update_barang/$1');
$routes->get('/sales/delete_foto_lain/(:num)', 'SalesController::delete_foto_lain/$1');
$routes->get('/sales/view_tambah_variasi/(:num)',  'SalesController::view_tambah_variasi/$1');
$routes->delete('/sales/delete_variasi/(:num)', 'SalesController::delete_variasi/$1');
$routes->get('/sales/tambah_opsi/(:num)',  'SalesController::tambah_opsi/$1');
$routes->get('/sales/edit_opsi/(:num)', 'SalesController::edit_opsi/$1');
$routes->post('/sales/update_opsi', 'SalesController::update_opsi');
$routes->post('/sales/store_opsi',  'SalesController::store_opsi');
$routes->post('/sales/store_barang',  'SalesController::store_barang');
$routes->post('/sales/sub_kategori',  'SalesController::sub_kategori');
$routes->delete('/sales/delete_barang/(:num)',  'SalesController::delete_barang/$1');
$routes->post('sales/delete_opsi/(:num)', 'SalesController::deleteOpsi/$1');
$routes->get('sales/view_penarikan', 'SalesController::view_penarikan');
$routes->get('sales/add_penarikan', 'SalesController::add_penarikan');
$routes->post('/sales/store_penarikan',  'SalesController::store_penarikan');
$routes->get('/sales/foto_bukti/(:num)', 'SalesController::foto_bukti/$1');

$routes->get('user/wishlist', 'UserController::wishlist');

$routes->post('user/add_to_wishlist/(:num)', 'UserController::addToWishlist/$1');
$routes->get('user/delete_wishlist/(:num)', 'UserController::delete_wishlist/$1');


$routes->get('/user/detail/(:num)', 'UserController::detail/$1');
$routes->post('/user/review/(:any)', 'UserController::review/$1');


$routes->group('admin', function ($routes) {
    $routes->get('daftar-penjual', 'AdminController::daftarPenjual');

    // Rute untuk verifikasi penjual
    $routes->get('verifikasiPenjual/(:num)', 'AdminController::verifikasiPenjual/$1');

    // Rute untuk menolak penjual
    $routes->get('tolakPenjual/(:num)', 'AdminController::tolakPenjual/$1');
});

$routes->post('product/search', 'UserController::search');
$routes->get('product/search', 'UserController::search');

$routes->get('/sales/profilepenjual', 'SalesController::profilepenjual');
$routes->post('/sales/profilepenjual', 'SalesController::updateProfile');


$routes->get('shop', 'UserController::filter');

$routes->get('/sales/kemas_jasa', 'SalesController::kemasan_jasa');
$routes->get('/sales/kiriman_jasa', 'SalesController::kiriman_jasa');
$routes->post('/sales/kiriman/(:any)', 'SalesController::kiriman/$1');
$routes->get('/sales/selesai_jasa', 'SalesController::selesai_jasa');
$routes->post('/sales/selesaian/(:any)', 'SalesController::selesaian/$1');

$routes->get('myaccount', 'UserController::myaccount');
$routes->post('myaccount/update_profile', 'UserController::updateProfile');


$routes->get('/user/transaction-history', 'UserController::transactionHistory');
$routes->get('transactions/detail/(:num)', 'TransaksiController::detail/$1');
$routes->post('transactions/updateStatus/(:segment)', 'TransaksiController::updateStatus/$1');

