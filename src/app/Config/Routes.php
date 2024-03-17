<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
    // Routes inside the 'admin' group with controllers in the 'Admin' namespace
    // $routes->get('dashboard', 'AdminController::dashboard');
    // $routes->get('users', 'AdminController::users');
    // Add more routes specific to the 'admin' group as needed

    $routes->group('auth', ['namespace' => 'App\Controllers\Cms'], function ($routes) {
        $routes->get('signin', 'AuthController::signIn');
        $routes->post('signin', 'AuthController::signInProcess');
        $routes->get('signout', 'AuthController::signOut');
    });

    $routes->group('dashboard', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'DashboardController::index');
    });

    $routes->group('aset_desa', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'AsetDesaController::index');
        $routes->get('datatable', 'AsetDesaController::indexDataTable');
        $routes->get('new', 'AsetDesaController::new');
        $routes->post('create', 'AsetDesaController::create');
        $routes->get('show/(:num)', 'AsetDesaController::show/$1');
        $routes->post('upload_file', 'AsetDesaController::uploadFile');
        $routes->get('edit/(:num)', 'AsetDesaController::edit/$1');
        $routes->post('update/(:num)', 'AsetDesaController::update/$1');
        $routes->get('register/(:num)', 'AsetDesaController::register/$1');
    });

    $routes->group('jabatan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JabatanController::index');
        $routes->get('new', 'JabatanController::new');
        $routes->post('create', 'JabatanController::create');
        $routes->get('edit/(:num)', 'JabatanController::edit/$1');
        $routes->post('update/(:num)', 'JabatanController::update/$1');
        $routes->get('delete/(:num)', 'JabatanController::delete/$1');
    });

    $routes->group('agama', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'AgamaController::index');
        $routes->get('new', 'AgamaController::new');
        $routes->post('create', 'AgamaController::create');
        $routes->get('edit/(:num)', 'AgamaController::edit/$1');
        $routes->post('update/(:num)', 'AgamaController::update/$1');
        $routes->get('delete/(:num)', 'AgamaController::delete/$1');
    });

    $routes->group('jenis_pekerjaan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisPekerjaanController::index');
        $routes->get('new', 'JenisPekerjaanController::new');
        $routes->post('create', 'JenisPekerjaanController::create');
        $routes->get('edit/(:num)', 'JenisPekerjaanController::edit/$1');
        $routes->post('update/(:num)', 'JenisPekerjaanController::update/$1');
        $routes->get('delete/(:num)', 'JenisPekerjaanController::delete/$1');
    });

    $routes->group('lembaga', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'LembagaController::index');
        $routes->get('new', 'LembagaController::new');
        $routes->post('create', 'LembagaController::create');
        $routes->get('edit/(:num)', 'LembagaController::edit/$1');
        $routes->post('update/(:num)', 'LembagaController::update/$1');
        $routes->get('delete/(:num)', 'LembagaController::delete/$1');
    });

    $routes->group('provinsi', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'ProvinsiController::index');
        $routes->get('new', 'ProvinsiController::new');
        $routes->post('create', 'ProvinsiController::create');
        $routes->get('edit/(:num)', 'ProvinsiController::edit/$1');
        $routes->post('update/(:num)', 'ProvinsiController::update/$1');
        $routes->get('delete/(:num)', 'ProvinsiController::delete/$1');
    });

    $routes->group('perangkat_desa', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'PerangkatDesaController::index');
        $routes->get('new', 'PerangkatDesaController::new');
        $routes->post('create', 'PerangkatDesaController::create');
        $routes->post('testing', 'PerangkatDesaController::testing');
        $routes->get('edit/(:num)', 'PerangkatDesaController::edit/$1');
        $routes->post('update/(:num)', 'PerangkatDesaController::update/$1');
    });

    $routes->group('select2', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('jabatan', 'Select2Controller::jabatan');
        $routes->get('jabatan/(:num)', 'Select2Controller::jabatan/$1');
        $routes->get('pendidikan', 'Select2Controller::pendidikan');
        $routes->get('pendidikan/(:num)', 'Select2Controller::pendidikan/$1');
        $routes->get('provinsi', 'Select2Controller::provinsi');
        $routes->get('provinsi/(:num)', 'Select2Controller::provinsi/$1');
        $routes->get('kabupaten', 'Select2Controller::kabupaten');
        $routes->get('kabupaten/(:any)', 'Select2Controller::kabupaten/$1');
        $routes->get('jenis_galeri', 'Select2Controller::jenis_galeri');
        $routes->get('jenis_galeri/(:num)', 'Select2Controller::jenis_galeri/$1');
        $routes->get('jenis_berita', 'Select2Controller::jenis_berita');
        $routes->get('jenis_berita/(:num)', 'Select2Controller::jenis_berita/$1');
    });

    $routes->group('pendidikan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'PendidikanController::index');
        $routes->get('new', 'PendidikanController::new');
        $routes->post('create', 'PendidikanController::create');
        $routes->get('edit/(:num)', 'PendidikanController::edit/$1');
        $routes->post('update/(:num)', 'PendidikanController::update/$1');
        $routes->get('delete/(:num)', 'PendidikanController::delete/$1');
    });

    $routes->group('kabupaten', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'KabupatenController::index');
        $routes->get('new', 'KabupatenController::new');
        $routes->post('create', 'KabupatenController::create');
        $routes->get('edit/(:num)', 'KabupatenController::edit/$1');
        $routes->post('update/(:num)', 'KabupatenController::update/$1');
        $routes->get('delete/(:num)', 'KabupatenController::delete/$1');
    });

    $routes->group('kecamatan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'KecamatanController::index');
        $routes->get('new', 'KecamatanController::new');
        $routes->post('create', 'KecamatanController::create');
        $routes->get('edit/(:num)', 'KecamatanController::edit/$1');
        $routes->post('update/(:num)', 'KecamatanController::update/$1');
        $routes->get('delete/(:num)', 'KecamatanController::delete/$1');
    });

    $routes->group('jenis_berita', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisBeritaController::index');
        $routes->get('new', 'JenisBeritaController::new');
        $routes->post('create', 'JenisBeritaController::create');
        $routes->get('edit/(:num)', 'JenisBeritaController::edit/$1');
        $routes->post('update/(:num)', 'JenisBeritaController::update/$1');
        $routes->get('delete/(:num)', 'JenisBeritaController::delete/$1');
    });

    $routes->group('jenis_galeri', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisGaleriController::index');
        $routes->get('new', 'JenisGaleriController::new');
        $routes->post('create', 'JenisGaleriController::create');
        $routes->get('edit/(:num)', 'JenisGaleriController::edit/$1');
        $routes->post('update/(:num)', 'JenisGaleriController::update/$1');
        $routes->get('delete/(:num)', 'JenisGaleriController::delete/$1');
    });

    $routes->group('galeri_desa', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'GaleriDesaController::index');
        $routes->get('new', 'GaleriDesaController::new');
        $routes->post('create', 'GaleriDesaController::create');
        $routes->get('edit/(:num)', 'GaleriDesaController::edit/$1');
        $routes->post('update/(:num)', 'GaleriDesaController::update/$1');
        $routes->get('delete/(:num)', 'GaleriDesaController::delete/$1');
    });

    $routes->group('kabar_desa', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'KabarDesaController::index');
        $routes->get('new', 'KabarDesaController::new');
        $routes->post('create', 'KabarDesaController::create');
        $routes->get('edit/(:num)', 'KabarDesaController::edit/$1');
        $routes->post('update/(:num)', 'KabarDesaController::update/$1');
        $routes->get('delete/(:num)', 'KabarDesaController::delete/$1');
        $routes->post('hapus_gambar', 'KabarDesaController::hapus_gambar');
        $routes->post('upload_file', 'KabarDesaController::uploadFile');
    });

    $routes->group('aset_di_desa', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'AsetDiDesaController::index');
        $routes->get('new', 'AsetDiDesaController::new');
        $routes->post('create', 'AsetDiDesaController::create');
        $routes->get('edit/(:num)', 'AsetDiDesaController::edit/$1');
        $routes->post('update/(:num)', 'AsetDiDesaController::update/$1');
        $routes->get('delete/(:num)', 'AsetDiDesaController::delete/$1');
        $routes->post('hapus_gambar', 'AsetDiDesaController::hapus_gambar');
        $routes->post('upload_file', 'AsetDiDesaController::uploadFile');
    });

    $routes->group('status_pemilik', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'StatusPemilikController::index');
        $routes->get('new', 'StatusPemilikController::new');
        $routes->post('create', 'StatusPemilikController::create');
        $routes->get('edit/(:num)', 'StatusPemilikController::edit/$1');
        $routes->post('update/(:num)', 'StatusPemilikController::update/$1');
        $routes->get('delete/(:num)', 'StatusPemilikController::delete/$1');
    });

    $routes->group('jenis_pajak', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisPajakController::index');
        $routes->get('new', 'JenisPajakController::new');
        $routes->post('create', 'JenisPajakController::create');
        $routes->get('edit/(:num)', 'JenisPajakController::edit/$1');
        $routes->post('update/(:num)', 'JenisPajakController::update/$1');
        $routes->get('delete/(:num)', 'JenisPajakController::delete/$1');
    });

    $routes->group('jenis_aset', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisAsetController::index');
        $routes->get('new', 'JenisAsetController::new');
        $routes->post('create', 'JenisAsetController::create');
        $routes->get('edit/(:num)', 'JenisAsetController::edit/$1');
        $routes->post('update/(:num)', 'JenisAsetController::update/$1');
        $routes->get('delete/(:num)', 'JenisAsetController::delete/$1');
    });

    $routes->group('jenis_peraturan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'JenisPeraturanController::index');
        $routes->get('new', 'JenisPeraturanController::new');
        $routes->post('create', 'JenisPeraturanController::create');
        $routes->get('edit/(:num)', 'JenisPeraturanController::edit/$1');
        $routes->post('update/(:num)', 'JenisPeraturanController::update/$1');
        $routes->get('delete/(:num)', 'JenisPeraturanController::delete/$1');
    });

    $routes->group('peraturan', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('index', 'PeraturanController::index');
        $routes->get('new', 'PeraturanController::new');
        $routes->post('create', 'PeraturanController::create');
        $routes->get('edit/(:num)', 'PeraturanController::edit/$1');
        $routes->post('update/(:num)', 'PeraturanController::update/$1');
        $routes->get('delete/(:num)', 'PeraturanController::delete/$1');
    });

    $routes->group('profil', ['namespace' => 'App\Controllers\Cms', 'filter' => 'auth'], function ($routes) {
        $routes->get('/', 'ProfilDesaController::edit');
        $routes->post('update/(:num)', 'ProfilDesaController::update/$1');
    });
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    // Routes inside the 'api' group with a specific namespace
    $routes->get('users', 'UserController::index');
    $routes->post('users', 'UserController::create');
    // Add more API routes as needed
});
