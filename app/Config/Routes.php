<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'LoginController::index');

$routes->post('posisipcl','PosisiPclController::index');

$routes->post('updateposisi','PosisiPclController::updateLokasiPcl');

$routes->post('listing/sinkronisasi-ruta', 'ListingController::sinkronisasiRuta'); // sinkronisasi ruta mencakup insert, update, delete
$routes->get('listing/generate-sampel/(:segment)', 'ListingController::generateSampel/$1'); // generate sampel dari suatu BS tertentu
$routes->delete('listing/delete-sampel/(:segment)', 'ListingController::hapusSampelBS/$1'); // Menghapus sampel dari suatu BS tertentu
$routes->get('latestversion', 'LatestVersionController::sinkronisasiRuta'); // INI PEMANGGILAN SINKRONISASI RUTA SALAH

$routes->post('listing/update-bs', 'WilayahKerjaController::updateStatusBs'); // update bs

$routes->post('listing/finalisasi-ruta', 'ListingController::finalisasiRuta'); // finalisasi ruta
// $routes->get('check/(:segment)', 'ListingController::generateSampel/$1');