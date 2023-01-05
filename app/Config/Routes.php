<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeKhuong');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions

 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeKhuong::index');

//upload file
$routes->group('user', function ($routes){
    $routes->get('form-add','userController::formAdd');
    $routes->get('delete/(:num)','userController::remove/$1');
    $routes->match(['get','post'],'update/(:num)','userController::edit/$1');
    $routes->match(['get','post'],'create','userController::add');
});

//Nghĩa
$routes->group('search', function($routes){
    $routes->get('/', 'Search::index');
    $routes->get('index', 'Search::index');
    $routes->match(['get', 'post'], 'add', 'Search::add');
	$routes->match(['get', 'post'], 'setting/(:num)', 'Search::setting/$1');

    $routes->group('ajax', function($routes){
        $routes->post('getquery', 'Search::myQuery');
        $routes->match(['get', 'post'] ,'del', 'Search::del');
    });
});

//Huy
// $routes->get('/', 'Home::index');
$routes->get('report', 'Report::index');
$routes->get('export-excel', 'Report::export');
$routes->get('crud', 'CRUD::select');
$routes->get('delete/(:any)', 'CRUD::deleteUser/$1');
$routes->match(['get', 'post'], 'crud/insert', 'CRUD::insert');
$routes->match(['get', 'post'], 'crud/update/(:any)', 'CRUD::insert/$1');

//Kiên
$routes->get('import', 'importExcel::index');
$routes->get('download', 'importExcel::download');
$routes->get('upload', 'importExcel::upload');
// $routes->get('add', 'importExcel::add');
$routes->match(['get' , 'post'], 'upload' , 'importExcel::upload');
$routes->get('delete/(:num)' , 'importExcel::delete/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
