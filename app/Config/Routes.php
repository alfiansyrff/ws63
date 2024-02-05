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
$routes->delete('listing/delete-sampel/(:segment)', 'ListingController::hapusSampelBS/$1');
$routes->get('listing/get-sampel/(:segment)', 'ListingController::getSampelBS/$1'); // Menghapus sampel dari suatu BS tertentu
$routes->post('listing/update-bs-status', 'WilayahKerjaController::updateStatusBs'); // update bs
$routes->get('listing/get-info-bs/(:segment)', 'WilayahKerjaController::getInfoBS/$1'); // update bs
$routes->get('listing/finalisasi-bs/(:segment)', 'ListingController::finalisasiBS/$1'); // finalisasi ruta
$routes->get('listing/confirm-sampel/(:segment)', 'ListingController::confirmSampel/$1'); // finalisasi ruta

$routes->get('latestversion', 'LatestVersionController::index'); // INI PEMANGGILAN SINKRONISASI RUTA SALAH
