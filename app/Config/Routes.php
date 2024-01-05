<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'LoginController::index');

$routes->post('posisipcl','PosisiPclController::index');

$routes->post('updateposisi','PosisiPclController::updateLokasiPcl');

$routes->post('listing/sinkronisasi-ruta/sinkronisasi-ruta', 'ListingController::sinkronisasiRuta'); // sinkronisasi ruta mencakup insert, update, delete

$routes->get('latestversion', 'LatestVersionController::sinkronisasiRuta'); // sinkronisasi ruta mencakup insert, update, delete

$routes->get('check-danang', 'WilayahKerjaController::index');