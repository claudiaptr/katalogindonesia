<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/dashboard', 'Home::index');

// login dan register admin
$routes->get('/auth/login', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');
$routes->add('/logout', 'Auth::logout');

// penjual
$routes->get('/daftar/penjual','Auth::daftar_penjual');
$routes->add('/store/penjual','Auth::add_penjual');

// user
$routes->get('/', 'UserController::home');
$routes->get('/user/detail', 'UserController::detail');
$routes->get('/user/contact', 'UserController::contact');





