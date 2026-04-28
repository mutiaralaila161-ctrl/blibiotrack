<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Variabel Filter
$authFilter = ['filter' => 'auth'];

// Variabel Role
$admin     = ['filter' => 'role:admin'];
$petugas   = ['filter' => 'role:petugas'];
$anggota   = ['filter' => 'role:anggota'];
$intRole   = ['filter' => 'role:admin,petugas'];
$allRole   = ['filter' => 'role:admin,petugas,anggota'];


// ================= LOGIN =================
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::prosesLogin');
$routes->get('logout', 'Auth::logout');

// ================= HALAMAN UTAMA (WAJIB LOGIN) =================
$routes->get('/', 'Dashboard::index', $authFilter);
$routes->get('dashboard', 'Dashboard::index', $authFilter);


// ================= USER =================
$routes->get('/users/create', 'Users::create'); 
$routes->post('/users/store', 'Users::store'); 

$routes->get('/users', 'Users::index', $intRole);
$routes->get('/users/edit/(:num)', 'Users::edit/$1', $allRole);
$routes->post('/users/update/(:num)', 'Users::update/$1', $allRole);
$routes->get('/users/delete/(:num)', 'Users::delete/$1', $allRole);

$routes->get('users/detail/(:num)', 'Users::detail/$1', $allRole);
$routes->get('users/print', 'Users::print', $allRole);
$routes->get('users/wa/(:num)', 'Users::wa/$1', $allRole);

$routes->get('users/aktifkan/(:num)', 'Users::aktifkan/$1');
$routes->get('users/nonaktifkan/(:num)', 'Users::nonaktifkan/$1');

$routes->get('register', 'Auth::registerForm');
$routes->post('register', 'Auth::register');

$routes->get('buku', 'Buku::index');
$routes->get('buku/create', 'Buku::create');
$routes->post('buku/store', 'Buku::store');
$routes->get('buku/detail/(:num)', 'Buku::detail/$1');
$routes->get('buku/edit/(:num)', 'Buku::edit/$1');
$routes->post('buku/update/(:num)', 'Buku::update/$1');
$routes->get('buku/delete/(:num)', 'Buku::delete/$1');
$routes->get('buku/print', 'Buku::print');
$routes->get('buku/wa/(:num)', 'Buku::wa/$1');

$routes->get('kategori', 'Kategori::index');
$routes->get('kategori/create', 'Kategori::create');
$routes->post('kategori/store', 'Kategori::store');
$routes->get('kategori/edit/(:num)', 'Kategori::edit/$1');
$routes->post('kategori/update/(:num)', 'Kategori::update/$1');
$routes->get('kategori/delete/(:num)', 'Kategori::delete/$1');

$routes->get('penulis', 'Penulis::index');
$routes->get('penulis/create', 'Penulis::create');
$routes->post('penulis/store', 'Penulis::store');
$routes->get('penulis/edit/(:num)', 'Penulis::edit/$1');
$routes->post('penulis/update/(:num)', 'Penulis::update/$1');
$routes->get('penulis/delete/(:num)', 'Penulis::delete/$1');

$routes->get('penerbit', 'Penerbit::index');
$routes->get('penerbit/create', 'Penerbit::create');
$routes->post('penerbit/store', 'Penerbit::store');
$routes->get('penerbit/edit/(:num)', 'Penerbit::edit/$1');
$routes->post('penerbit/update/(:num)', 'Penerbit::update/$1');
$routes->get('penerbit/delete/(:num)', 'Penerbit::delete/$1');

$routes->get('rak', 'Rak::index');
$routes->get('rak/create', 'Rak::create');
$routes->post('rak/store', 'Rak::store');
$routes->get('rak/edit/(:num)', 'Rak::edit/$1');
$routes->post('rak/update/(:num)', 'Rak::update/$1');
$routes->get('rak/delete/(:num)', 'Rak::delete/$1');

// ================= PEMINJAMAN =================
$routes->group('peminjaman', ['filter' => 'role:admin,petugas,anggota'], function($routes) {

    $routes->get('/', 'Peminjaman::index');
    $routes->get('create', 'Peminjaman::create');
    $routes->post('save', 'Peminjaman::save');

    $routes->get('detail/(:num)', 'Peminjaman::detail/$1');
    $routes->get('print', 'Peminjaman::print');

    $routes->get('delete/(:num)', 'Peminjaman::delete/$1');
 
    $routes->get('verifikasi-kembali/(:num)', 'Peminjaman::verifikasiKembali/$1');
    $routes->get('approve/(:num)', 'Peminjaman::approve/$1');
    $routes->get('reject/(:num)', 'Peminjaman::reject/$1');

    // ✅ FIX DENDA (INI YANG BENAR)
    $routes->get('bayarDenda/(:num)', 'Peminjaman::bayarDenda/$1');
    $routes->get('verifikasiDenda/(:num)', 'Peminjaman::verifikasiDenda/$1');

});

// ================= PENGEMBALIAN =================
$routes->group('pengembalian', function ($routes) {

    $routes->get('/', 'Pengembalian::index');
    $routes->get('form/(:num)', 'Pengembalian::form/$1');
    $routes->get('proses/(:num)', 'Pengembalian::proses/$1');
});


// ================= DENDA (VIEW SAJA) =================
$routes->group('denda', function($routes) {

    $routes->get('/', 'Denda::index');
});

$routes->get('transaksi', 'Transaksi::index');
$routes->get('transaksi/create/(:num)', 'Transaksi::create/$1');
$routes->post('transaksi/save', 'Transaksi::save');

$routes->get('transaksi/bayar/(:num)', 'Transaksi::bayar/$1');
$routes->get('transaksi/verifikasi/(:num)', 'Transaksi::verifikasi/$1');

$routes->get('/backup', 'Backup::index');

$routes->get('/restore', 'Restore::index');
$routes->post('/restore/auth', 'Restore::auth');
$routes->get('/restore/form', 'Restore::form');
$routes->post('/restore/process', 'Restore::process');

