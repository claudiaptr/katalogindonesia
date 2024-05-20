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


// login dan register admin
$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');
//Auth


$routes->get('/user/detail', 'UserController::detail');
$routes->get('/user/contact', 'UserController::contact');
$routes->get('/user/checkout', 'UserController::checkout');
$routes->get('/user/cart', 'UserController::cart');
$routes->get('/sales/home', 'SalesController::home');


//User
$routes->get('/user/home', 'UserController::home');
$routes->get('/user/shop', 'UserController::shop');

//Logout
$routes->add('/logout', 'Auth::logout');

// penjual
$routes->get('/daftar/penjual','Auth::daftar_penjual');
$routes->add('/store/penjual','Auth::add_penjual');
$routes->get('/sales/home', 'SalesController::home');
$routes->get('/sales/view_barang','SalesController::view_barang');
$routes->get('/sales/add_barang','SalesController::add_barang');
$routes->get('/sales/edit_barang/(:num)','SalesController::edit_barang/$1');
$routes->post('/sales/store_barang','SalesController::store_barang');


// user
$routes->get('/', 'UserController::home');
$routes->get('/user/detail', 'UserController::detail');
$routes->get('/user/contact', 'UserController::contact');





