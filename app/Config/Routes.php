<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'LoginController::index');
$routes->post('listing', 'ListingController::index');

$routes->get('check-danang', 'WilayahKerjaController::index');