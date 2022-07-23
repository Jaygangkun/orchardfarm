<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Page');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Page::applications');
$routes->get('/login', 'Page::login');
// $routes->post('/login', 'Page::login');
$routes->get('/logout', 'Page::logout');
$routes->get('/applications', 'Page::applications');
$routes->get('/application-view/(:any)', 'Page::applicationView/$1');

$routes->get('/apply', 'Page::apply');
$routes->get('/apply-view/(:any)', 'Page::applyView/$1');
$routes->post('/submit-application', 'Page::submitApplication');
$routes->post('/update-application', 'Page::updateApplication');
$routes->post('/delete-application', 'Page::deleteApplication');
// $routes->get('/qr', 'Page::qr');

$routes->get('/apiApplicatnsLoad', 'Page::apiApplicantsLoad');


$routes->post('/generate-qr', 'Page::generateQR');
$routes->get('/qrtest', 'Page::qrTest');
$routes->get('/test', 'Page::test');

// APIS
$routes->group("api", function ($routes) {
    $routes->post('login', 'APIUser::login');
    $routes->post('signup', 'APIUser::signup');
    $routes->post('forgot_password', 'APIUser::forgot_password');

    $routes->post('user/add', 'APIUser::add', ['filter' => 'authFilter']);
    $routes->post("user/list", "APIUser::list", ['filter' => 'authFilter']);
    $routes->post('user/role_add', 'APIUser::role_add', ['filter' => 'authFilter']);

    $routes->post('livestock/source_add', 'APILivestock::source_add', ['filter' => 'authFilter']);
    $routes->post('livestock/add', 'APILivestock::add', ['filter' => 'authFilter']);
    $routes->post('livestock/list', 'APILivestock::list', ['filter' => 'authFilter']);
    $routes->post('livestock/offspring_list', 'APILivestock::offspring_list', ['filter' => 'authFilter']);

    $routes->post('event/group_add', 'APIEvent::group_add', ['filter' => 'authFilter']);
    $routes->post('event/individual_add', 'APIEvent::individual_add', ['filter' => 'authFilter']);
    $routes->post('event/type_add', 'APIEvent::type_add', ['filter' => 'authFilter']);

    $routes->post('financial/category_add', 'APIFinancial::category_add', ['filter' => 'authFilter']);
    $routes->post('financial/transaction_add', 'APIFinancial::transaction_add', ['filter' => 'authFilter']);

    $routes->post('farm/profile', 'APIFarm::profile', ['filter' => 'authFilter']);

    $routes->post('pen/add', 'APIPen::add', ['filter' => 'authFilter']);
    $routes->post('pen/list', 'APIPen::list', ['filter' => 'authFilter']);

    $routes->post('animal_status/add', 'APIAnimalStatus::add', ['filter' => 'authFilter']);
    $routes->post('animal_status/list', 'APIAnimalStatus::list', ['filter' => 'authFilter']);

    $routes->post('animal_type/add', 'APIAnimalType::add', ['filter' => 'authFilter']);
    $routes->post('animal_type/list', 'APIAnimalType::list', ['filter' => 'authFilter']);

    $routes->post('breed/add', 'APIBreed::add', ['filter' => 'authFilter']);
    $routes->post('breed/list', 'APIBreed::list', ['filter' => 'authFilter']);

    $routes->post('medicine/add', 'APIMedicine::add', ['filter' => 'authFilter']);
    $routes->post('medicine/list', 'APIMedicine::list', ['filter' => 'authFilter']);

    $routes->post('medicine_type/add', 'APIMedicineType::add', ['filter' => 'authFilter']);
    $routes->post('medicine_type/list', 'APIMedicineType::list', ['filter' => 'authFilter']);

    $routes->post('insurance/add', 'APIInsurance::add', ['filter' => 'authFilter']);
    $routes->post('insurance/list', 'APIInsurance::list', ['filter' => 'authFilter']);

});





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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

