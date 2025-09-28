<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->group('', ['filter' => 'auth'], static function($routes) {
	$routes->get('/barangs', 'BarangController::index');
	$routes->get('/barangs/create', 'BarangController::create');
	$routes->post('/barangs/store', 'BarangController::store');
	$routes->get('barangs/edit/(:num)', 'BarangController::edit/$1');
	$routes->post('barangs/update/(:num)', 'BarangController::update/$1');
	$routes->get('/barangs/delete/(:num)', 'BarangController::delete/$1');
	$routes->get('/barangs/(:num)', 'BarangController::show/$1');
	$routes->get('/barangs/pdf/(:num)', 'BarangController::pdf/$1');
	$routes->get('/barangs/stok-habis', 'BarangController::stokHabis');
	$routes->get('/barangs/laporan-kategori', 'BarangController::laporanKategori');
	$routes->post('/barangs/ajaxList', 'BarangController::ajaxList');
});



