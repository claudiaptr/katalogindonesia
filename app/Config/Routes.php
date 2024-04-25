<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Admin
$routes->get('/admin/dashboard', 'Home::index');

//Auth
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');

//User
$routes->get('/user/home', 'UserController::home');
$routes->get('/user/shop', 'UserController::shop');

//Logout
$routes->add('/logout', 'Auth::logout');
