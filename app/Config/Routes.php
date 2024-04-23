<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Home::index');
$routes->get('/', 'Auth::login');
$routes->get('/register', 'Auth::register');
