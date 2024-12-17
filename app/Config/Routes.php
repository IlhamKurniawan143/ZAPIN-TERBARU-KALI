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
$routes->setAutoRoute(true);
// $routes->get('/coba', function () {
//     echo 'hello amel';
// });

// $routes->get('/users', 'Admin\Users::index');

