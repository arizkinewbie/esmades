<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
    // Routes inside the 'admin' group with controllers in the 'Admin' namespace
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    // Add more routes specific to the 'admin' group as needed

    $routes->group('auth', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('signin', 'AuthController::signIn');
        $routes->post('signin', 'AuthController::signInProcess');
        $routes->get('signout', 'AuthController::signOut');
    });
    
    $routes->group('dashboard', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('index', 'DashboardController::index');
    });
    
    $routes->group('aset_desa', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('index', 'AsetDesaController::index');
        $routes->get('datatable', 'AsetDesaController::indexDataTable');
    });
    
    $routes->group('jabatan', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('index', 'JabatanController::index');
        $routes->get('new', 'JabatanController::new');
        $routes->post('create', 'JabatanController::create');
        $routes->get('edit/(:num)', 'JabatanController::edit/$1');
        $routes->post('update/(:num)', 'JabatanController::update/$1');
    });

    $routes->group('agama', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('index', 'AgamaController::index');
        $routes->get('new', 'AgamaController::new');
        $routes->post('create', 'AgamaController::create');
        $routes->get('edit/(:num)', 'AgamaController::edit/$1');
        $routes->post('update/(:num)', 'AgamaController::update/$1');
    });

    $routes->group('jenis_pekerjaan', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('index', 'JenisPekerjaanController::index');
        $routes->get('new', 'JenisPekerjaanController::new');
        $routes->post('create', 'JenisPekerjaanController::create');
        $routes->get('edit/(:num)', 'JenisPekerjaanController::edit/$1');
        $routes->post('update/(:num)', 'JenisPekerjaanController::update/$1');
    });
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    // Routes inside the 'api' group with a specific namespace
    $routes->get('users', 'UserController::index');
    $routes->post('users', 'UserController::create');
    // Add more API routes as needed
});