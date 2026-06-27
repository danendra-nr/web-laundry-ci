<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerProcess');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');

    // Pelanggan
    $routes->get('pelanggan', 'PelangganController::index');
    $routes->get('pelanggan/create', 'PelangganController::create');
    $routes->post('pelanggan/store', 'PelangganController::store');
    $routes->get('pelanggan/edit/(:num)', 'PelangganController::edit/$1');
    $routes->post('pelanggan/update/(:num)', 'PelangganController::update/$1');
    $routes->post('pelanggan/delete/(:num)', 'PelangganController::delete/$1');

    // Layanan
    $routes->get('layanan', 'LayananController::index');
    $routes->get('layanan/create', 'LayananController::create');
    $routes->post('layanan/store', 'LayananController::store');
    $routes->get('layanan/edit/(:num)', 'LayananController::edit/$1');
    $routes->post('layanan/update/(:num)', 'LayananController::update/$1');
    $routes->post('layanan/delete/(:num)', 'LayananController::delete/$1');

    // Transaksi
    $routes->get('transaksi', 'TransaksiController::index');
    $routes->get('transaksi/create', 'TransaksiController::create');
    $routes->post('transaksi/store', 'TransaksiController::store');
    $routes->get('transaksi/detail/(:num)', 'TransaksiController::detail/$1');
    $routes->get('transaksi/edit/(:num)', 'TransaksiController::edit/$1');
    $routes->post('transaksi/update/(:num)', 'TransaksiController::update/$1');
    $routes->post('transaksi/delete/(:num)', 'TransaksiController::delete/$1');
    $routes->post('transaksi/status/(:num)', 'TransaksiController::status/$1');
    $routes->post('transaksi/updateDelivery/(:num)', 'TransaksiController::updateDelivery/$1');

    // Laporan
    $routes->get('laporan', 'LaporanController::index');

    // Pengaturan
    $routes->get('pengaturan', 'PengaturanController::index');
    $routes->post('pengaturan/update', 'PengaturanController::update');
    $routes->post('pengaturan/updatePassword', 'PengaturanController::updatePassword');

    // Kelola User
    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/edit/(:num)', 'UserController::edit/$1');
    $routes->post('user/update/(:num)', 'UserController::update/$1');
    $routes->post('user/delete/(:num)', 'UserController::delete/$1');
});

$routes->group('customer', ['filter' => 'customer_auth'], function($routes) {
    $routes->get('dashboard', 'CustomerController::index');
    $routes->get('pesan', 'CustomerController::createOrder');
    $routes->post('pesan', 'CustomerController::storeOrder');
});
