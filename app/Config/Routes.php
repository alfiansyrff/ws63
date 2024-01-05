<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'LoginController::index');

$routes->post('posisipcl','PosisiPclController::index');

$routes->post('updateposisi','PosisiPclController::updateLokasiPcl');

$routes->post('listing', 'ListingController::index');

$routes->get('latestversion', 'LatestVersionController::index');

$routes->get('check-danang', 'WilayahKerjaController::index');