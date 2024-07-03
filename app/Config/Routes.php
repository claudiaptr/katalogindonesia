<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Admin
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


// login dan register admin
$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');
$routes->get('/auth/register_google', 'Auth::register_google');
//Auth


$routes->get('/user/detail/(:num)', 'UserController::detail/$1');
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
$routes->get('/user/contact', 'UserController::contact');
$routes->get('/tracking', 'UserController::tracking');                                         
$routes->post('/user/harga_barang', 'UserController::harga_barang');
$routes->get('/user/delete_chart/(:any)', 'UserController::delete_cart/$1');


$routes->get('/user/cek', 'UserController::cek');



//Logout
$routes->add('/logout', 'Auth::logout');

// penjual
$routes->get('/daftar/penjual', 'Auth::daftar_penjual');
$routes->add('/store/penjual', 'Auth::add_penjual');
$routes->get('/sales/home', 'SalesController::home');
$routes->get('/sales/view_barang', 'SalesController::view_barang');
$routes->get('/sales/add_barang', 'SalesController::add_barang');
$routes->get('/sales/edit_barang/(:num)', 'SalesController::edit_barang/$1');
$routes->post('/sales/update_barang/(:num)', 'SalesController::update_barang/$1');
$routes->get('/sales/delete_foto_lain/(:num)', 'SalesController::delete_foto_lain/$1');
$routes->get('/sales/view_tambah_variasi/(:num)', 'SalesController::view_tambah_variasi/$1');
$routes->delete('/sales/delete_variasi/(:num)', 'SalesController::delete_variasi/$1');
$routes->get('/sales/tambah_opsi/(:num)', 'SalesController::tambah_opsi/$1');
$routes->get('/sales/edit_opsi/(:num)', 'SalesController::edit_opsi/$1');
$routes->post('/sales/update_opsi/(:num)', 'SalesController::update_opsi/$1');
$routes->post('/sales/store_opsi', 'SalesController::store_opsi');
$routes->post('/sales/store_barang', 'SalesController::store_barang');
$routes->post('/sales/sub_kategori', 'SalesController::sub_kategori');
$routes->delete('/sales/delete_barang/(:num)', 'SalesController::delete_barang/$1');
$routes->post('sales/delete_opsi/(:num)', 'SalesController::deleteOpsi/$1');

// user
