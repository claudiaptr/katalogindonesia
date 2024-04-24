<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/dashboard', 'Home::index');
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/user/home', 'UserController::home');
$routes->get('/auth/register', 'Auth::register');
$routes->add('/auth/save_register', 'Auth::save_register');
$routes->add('/auth/cek_login', 'Auth::cek_login');


$routes->add('/logout', 'Auth::logout');
