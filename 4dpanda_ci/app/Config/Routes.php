<?php namespace Config;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Config\BaseConfig;
/**
 * @var RouteCollection $routes
 */

$routes = Services::routes();
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
/* Results by Region */
$routes->get('malaysia-4d-results', 'Home::myresultsindex');
$routes->get('sabah-sarawak-4d-results', 'Home::westmyresultsindex');
$routes->get('singapore-4d-results', 'Home::singaporeresultsindex');
$routes->get('cambodia-4d-results', 'Home::cambodiaresultsindex');
/* Results by Type*/
$routes->get('results/magnum', 'Home::myresultsindex/magnum');
$routes->get('results/damacai', 'Home::myresultsindex/damacai');
$routes->get('results/toto', 'Home::myresultsindex/toto');
$routes->get('results/singapore-pools', 'Home::singaporeresultsindex/singapore-pools');
$routes->get('results/sabah-88', 'Home::westmyresultsindex/sabah');
$routes->get('results/sandakan', 'Home::westmyresultsindex/sandakan');
$routes->get('results/sarawak', 'Home::westmyresultsindex/sarawak');
$routes->get('results/gd-lotto', 'Home::cambodiaresultsindex/gd');
$routes->get('results/perdana', 'Home::cambodiaresultsindex/perdana');
$routes->get('results/lucky-hari', 'Home::cambodiaresultsindex/lucky');
$routes->get('results/lotto-macao', 'Home::othersresultsindex/lmc');
$routes->get('results/matahari', 'Home::othersresultsindex/mth');
$routes->get('results/9-lotto', 'Home::cambodiaresultsindex/nlt');

////

$routes->get('/fetchall', 'LotteryData::fetchAll');
// for Past Results pages
$routes->get('/past-results', 'LotteryData::past_results_index');
$routes->get('/past-results/(:segment)', 'LotteryData::past_results_by_date/$1');
$routes->post('fetchpastresults','LotteryData::fetch_past_results');
$routes->get('fetchpastresults','LotteryData::fetch_past_results');

$routes->post('fetchall', 'LotteryData::fetchAll');
$routes->cli('lottery:fetch', 'FetchLotteryData');
$routes->cli('lottery:specialcashsweep', 'FetchSpecialCashSweep');
$routes->cli('lottery:magnum', 'FetchMagnum');
$routes->cli('lottery:fetchtoto', 'FetchToto');
$routes->cli('lottery:fetch9toto', 'FetchNineToto');
$routes->cli('lottery:fetchsingaporepools', 'FetchSingaporePools');
$routes->cli('lottery:fetchsandakan', 'FetchSandakan');

// More

$routes->get('/estimated-jackpot', 'Home::estimatedJackpotsIndex');
$routes->get('/4d-special-draw', 'Home::specialDrawIndex');
$routes->get('/recent-news', 'PostController::viewRecentNewsIndex');
$routes->get('/4d-result-api', 'PostController::view/4d-result-api');
$routes->get('/history', 'SearchController::index');
$routes->get('/history/(:num)', 'SearchController::numberIndex/$1');
$routes->get('/dictionary', 'SearchController::meaningIndex');
$routes->get('/dictionary/(:segment)', 'SearchController::wordIndex/$1');
$routes->get('/hot-number', 'SearchController::hotnumberIndex');
$routes->post('fetchhistoryresults', 'SearchController::fetchhistoryresultsIndex');
$routes->get('fetchhistoryresults', 'SearchController::fetchhistoryresultsIndex');
$routes->get('4d-prediction', 'OtherPagesController::predictionIndex');

//api
$routes->get('/api', 'ApiController::apiIndex');
//footer
$routes->get('/disclaimer', 'PostController::view/disclaimer');
$routes->get('/privacy-policy', 'PostController::view/privacy-policy');
$routes->get('/faq', 'PostController::view/faq');
$routes->get('/about-us', 'PostController::view/about-us');
$routes->get('/contact-us', 'PostController::view/contact-us');
//$routes->get('/(:segment)', 'PostController::view/$1');
$routes->get('sitemap\.xml', 'OtherPagesController::sitemapIndex');

// Backend
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('settings', 'SettingsController::index');
    $routes->get('lottery', 'SettingsController::lotteryIndex');
    $routes->get('number-pages', 'SettingsController::numberPagesIndex');
    $routes->get('sitemap', 'SettingsController::sitemapAdminIndex');
    $routes->post('settings/save', 'SettingsController::save');
    $routes->post('lottery/savelottery', 'SettingsController::saveLottery');
    $routes->post('settings/saveNumberPage', 'SettingsController::saveNumberPage');
    $routes->post('sitemap/saveSitemap', 'SettingsController::saveSitemap');
    $routes->post('sitemap/updateOrder', 'SettingsController::updateOrder');
    $routes->post('settings/deleteOption', 'SettingsController::deleteOption');
});

$routes->get('admin/posts', 'PostController::index');
$routes->get('admin/posts/create', 'PostController::create');
$routes->post('admin/posts/store', 'PostController::store');
$routes->get('admin/posts/edit/(:num)', 'PostController::edit/$1');
$routes->post('admin/posts/update/(:num)', 'PostController::update/$1');
$routes->get('admin/posts/delete/(:num)', 'PostController::delete/$1');
$routes->post('admin/posts/deleteImage', 'PostController::deleteImage');
$routes->get('/recent-news/(:any)', 'PostController::view/$1');  // Route for viewing post by URI
$routes->get('/posts/(:any)', 'PostController::view/$1');  // Route for viewing post by URI
$routes->get('about-us','PostController::view/about-us');
//Login

$routes->get('admin/login', 'AuthController::index');
$routes->post('login/authenticate', 'AuthController::authenticate');
$routes->get('admin/logout', 'AuthController::logout');
$routes->get('admin/dashboard', 'DashboardController::index');

$routes->get('admin/users', 'UserController::index');
$routes->get('admin/users/create', 'UserController::create');
$routes->post('admin/users/store', 'UserController::store');
$routes->get('admin/users/edit/(:num)', 'UserController::edit/$1');
$routes->post('admin/users/update/(:num)', 'UserController::update/$1');
$routes->get('admin/users/delete/(:num)', 'UserController::delete/$1');

// app/Config/Routes.php

$routes->get('admin/categories', 'CategoryController::index');
$routes->get('admin/categories/create', 'CategoryController::create');
$routes->post('admin/categories/store', 'CategoryController::store');
$routes->get('admin/categories/edit/(:num)', 'CategoryController::edit/$1');
$routes->post('admin/categories/update/(:num)', 'CategoryController::update/$1');
$routes->get('admin/categories/delete/(:num)', 'CategoryController::delete/$1');

// Others
$routes->get('admin/elfinder/connector', 'ElfinderController::connector');
$routes->post('admin/elfinder/connector', 'ElfinderController::connector');
$routes->get('admin/elfinder/upload', 'ElfinderController::upload');
$routes->post('admin/elfinder/upload', 'ElfinderController::upload');

//Mobile App API
$routes->post('api/save_notification_settings', 'MobileAPIController::saveNotificationSettings');
$routes->post('api/add_favourite_numbers', 'MobileAPIController::addFavouriteNumbers');
$routes->get('api/add_favourite_numbers', 'MobileAPIController::addFavouriteNumbers');
$routes->post('api/remove_favourite_number', 'MobileAPIController::removeFavouriteNumber');
$routes->post('api/fetch_number_history', 'SearchController::apiNumberHistory');
$routes->get('api/get_hot_numbers', 'SearchController::apiHotNumbers');
$routes->get('api/get_4d_dictionary/(:any)', 'SearchController::api4DDictionary/$1');
$routes->get('api/get_estimated_jackpots', 'Home::apiEstimatedJackpots');
$routes->get('api/get_special_draw', 'Home::apiSpecialDraw');
$routes->get('api/fetchall', 'LotteryData::fetchAll');
$routes->get('api/getdates', 'LotteryData::getDates');
$routes->get('api/getdates/(:segment)', 'LotteryData::getDatesByMonthYear/$1');
$routes->get('api/fetchall/(:segment)', 'LotteryData::getLotteryByDate/$1');
//$routes->get('api/save_notification_settings', 'MobileAPIController::saveNotificationSettings');
//$routes->get('api/get_notification_settings/(:any)', 'ApiController::get_notification_settings');