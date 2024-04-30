<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Admin
$routes->get('/admin/dashboard', 'Home::index');

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

// user
$routes->get('/', 'UserController::home');
$routes->get('/user/detail', 'UserController::detail');
$routes->get('/user/contact', 'UserController::contact');





