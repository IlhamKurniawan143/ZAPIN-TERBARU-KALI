<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Page::index');
$routes->post('/login/authenticate', 'Page::authenticate');
$routes->get('/register', 'Page::register');
$routes->post('/register/authenticateRegister', 'Page::authenticateRegister');
$routes->get('/dashboard_pegawai', 'PageStudent::index');
$routes->get('/dashboard_pengajar', 'PageTeacher::index');

$routes->get('/gabung_kelas', 'Fitur::nampilKelas');
$routes->post('/fitur/gabungKelas', 'Fitur::gabungKelas');

$routes->get('/dashboard_pengajar/detailkelas/(:num)', 'Fitur::detailKelas/$1');
$routes->get('/dashboard_pengajar/profile', 'Fitur::profile');
$routes->post('/kelas/createTask/(:num)', 'Fitur::createTask/$1');
$routes->get('/dashboard_pengajar/buatkelas', 'Fitur::buatkelas');
$routes->post('logout', 'Fitur::logout');
$routes->get('/dashboard_pengajar/detailkelas/tugaskelas/(:num)', 'Fitur::edittugaskelas/$1');
$routes->post('/kelas/updateTask/(:num)', 'Fitur::updateTask/$1');
// $routes->get('/buat_kelas', 'Fitur::buatKelas');
$routes->get('/dashboard-pengajar/buatkelas', 'Fitur::buatKelas');
$routes->post('/fitur/buat_kelas', 'Fitur::createKelas');



$routes->get('/dashboard_pegawai/detailkelas/(:num)', 'Fitur::detailKelas/$1');


$routes->setAutoRoute(true);
// $routes->get('/coba', function () {
//     echo 'hello amel';
// });

// $routes->get('/users', 'Admin\Users::index');