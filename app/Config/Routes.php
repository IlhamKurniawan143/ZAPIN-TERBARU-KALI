<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Page::index');
$routes->get('/login', 'Page::login');
$routes->post('/login/authenticate', 'Page::authenticate');
$routes->get('/register', 'Page::register');
$routes->post('/register/authenticateRegister', 'Page::authenticateRegister');
$routes->get('/dashboard_pegawai', 'PageStudent::index');
$routes->get('/dashboard_pengajar', 'PageTeacher::index');
$routes->get('/gabung_kelas', 'Fitur::gabungKelas');
$routes->get('/fitur/gabung_kelas/', 'Fitur::gabungKelas');
$routes->get('/dashboard_pengajar/detailkelas/(:num)', 'Fitur::detailKelas/$1');
$routes->get('/dashboard_pengajar/profile', 'Fitur::profile');
$routes->post('/dashboard_pengajar/create-kelas', 'Fitur::createKelas');
$routes->post('/kelas/createTask/(:num)', 'Fitur::createTask/$1');
$routes->post('logout', 'Fitur::logout');



$routes->setAutoRoute(true);
// $routes->get('/coba', function () {
//     echo 'hello amel';
// });

// $routes->get('/users', 'Admin\Users::index');