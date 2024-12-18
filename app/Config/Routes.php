<?php

use App\Controllers\AdminController;
use App\Filters\CIFilter;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProductController::landingPage');

$routes->group('admin', static function ($routes) {
    // Untuk pengguna yang sudah login
    $routes->group('', ['filter' => 'cifilter:auth'], static function ($routes) {
        $routes->get('home', 'AdminController::index', ['as' => 'admin.home']);
        $routes->get('logout', 'AdminController::logoutHandler', ['as' => 'admin.logout']);
        $routes->get('profile', 'AdminController::profile', ['as' => 'admin.profile']);
        $routes->get('categories', 'AdminController::categories', ['as' => 'categories']);

        $routes->get('product', 'ProductController::index', ['as' => 'product.index']);
        $routes->get('product/create', 'ProductController::create', ['as' => 'product.create']);
        $routes->post('product', 'ProductController::store', ['as' => 'product.store']); 
        $routes->get('product/edit/(:segment)', 'ProductController::edit/$1', ['as' => 'product.edit']);
        $routes->get('transactions', 'TransactionController::index', ['as' => 'transactions.index']);
        $routes->get('transactions', 'TransactionController::index');
        $routes->get('transactions/create', 'TransactionController::create', ['as' => 'transactions.create']);
        $routes->post('transactions/store', 'TransactionController::store', ['as' => 'transactions.store']);
        $routes->get('transactions/download/(:num)', 'TransactionController::downloadStruk/$1', ['as' => 'transactions.download']);
        $routes->get('admin/home', 'AdminController::home', ['as' => 'admin.home']);
        $routes->post('product/edit/(:segment)', 'ProductController::update/$1', ['as' => 'product.update']);

        $routes->get('product/delete/(:segment)', 'ProductController::delete/$1', ['as' => 'product.delete']);
    });

    // Untuk pengguna tamu
    $routes->group('', ['filter' => 'cifilter:guest'], static function ($routes) {
        $routes->get('login', 'AuthController::loginForm', ['as' => 'admin.login.form']);
        $routes->post('login', 'AuthController::loginHandler', ['as' => 'admin.login.handler']);
        $routes->get('/', 'ProductController::landingPage');
    });
});
