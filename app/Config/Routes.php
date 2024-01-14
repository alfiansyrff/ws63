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
$routes->get('listing/get-sampel/(:segment)', 'ListingController::getSampelBS/$1'); // Mendapatkan data sampel dari suatu BS tertentu
$routes->get('listing/change-bs-status/(:segment)/(:any)', 'ListingController::changeBsStatus/$1/$2'); // untuk melakukan perubhan status dari BS
$routes->get('latestversion', 'LatestVersionController::sinkronisasiRuta'); // INI PEMANGGILAN SINKRONISASI RUTA SALAH

// $routes->get('check/(:segment)', 'ListingController::generateSampel/$1');