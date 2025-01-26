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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Admin', 'Admin::index',['filter' => 'role']);
$routes->get('/Admin', 'Admin::Setting',['filter' => 'role']);
$routes->get('/Admin/index', 'Admin::index',['filter' => 'role']);
$routes->get('/Admin/Setting', 'Admin::Setting',['filter' => 'role']);
$routes->get('/InfoToko/index', 'InfoToko::index',['filter' => 'role']);
$routes->get('/InfoToko', 'InfoToko::index',['filter' => 'role']);
$routes->get('/InfoToko/Input', 'InfoToko::Input',['filter' => 'role']);
$routes->get('/InfoToko', 'InfoToko::Input',['filter' => 'role']);
$routes->get('/InfoToko/Edit', 'InfoToko::Edit',['filter' => 'role']);
$routes->get('/InfoToko', 'InfoToko::Edit',['filter' => 'role']);
$routes->get('/InfoToko/Delete', 'InfoToko::Delete',['filter' => 'role']);
$routes->get('/InfoToko', 'InfoToko::Delete',['filter' => 'role']);
$routes->get('/Toko/index', 'Toko::index',['filter' => 'role']);
$routes->get('/Toko', 'Toko::index',['filter' => 'role']);
$routes->get('/Toko/Input', 'Toko::Input',['filter' => 'role']);
$routes->get('/Toko', 'Toko::Input',['filter' => 'role']);
$routes->get('/Toko/Edit', 'Toko::Edit',['filter' => 'role']);
$routes->get('/Toko', 'Toko::Edit',['filter' => 'role']);
$routes->get('/Toko/Delete', 'Toko::Delete',['filter' => 'role']);
$routes->get('/Toko', 'Toko::Delete',['filter' => 'role']);
$routes->get('/Wilayah/index', 'Wilayah::index',['filter' => 'role']);
$routes->get('/Wilayah', 'Wilayah::index',['filter' => 'role']);
$routes->get('/UserControll/index', 'UserControll::index',['filter' => 'role']);
$routes->get('/Wilayah', 'Wilayah::Input',['filter' => 'role']);
$routes->get('/UserControll/Input', 'UserControll::Input',['filter' => 'role']);
$routes->get('/Wilayah', 'Wilayah::Edit',['filter' => 'role']);
$routes->get('/UserControll/Edit', 'UserControll::Edit',['filter' => 'role']);
$routes->get('/Wilayah', 'Wilayah::Delete',['filter' => 'role']);
$routes->get('/UserControll/Delete', 'UserControll::Delete',['filter' => 'role']);
$routes->get('/UserControll', 'UserControll::index',['filter' => 'role']);
$routes->get('/UserControll/Edit', 'UserControll::Edit',['filter' => 'role']);
$routes->get('/UserControll', 'UserControll::Edit',['filter' => 'role']);
$routes->get('/UserControll/Input', 'UserControll::Input',['filter' => 'role']);
$routes->get('/UserControll', 'UserControll::Input',['filter' => 'role']);
$routes->get('/UserControll/Delete', 'UserControll::Delete',['filter' => 'role']);
$routes->get('/UserControll', 'UserControll::Delete',['filter' => 'role']);



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