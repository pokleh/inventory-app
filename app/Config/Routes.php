<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication Routes
$routes->get('/', 'Auth::index');
$routes->get('/auth', 'Auth::index');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('/auth/forgotPassword', 'Auth::forgotPassword');
$routes->post('/auth/attemptForgotPassword', 'Auth::attemptForgotPassword');
$routes->get('/auth/logout', 'Auth::logout');

// Dashboard Routes
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Admin Routes
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // User Management
    $routes->get('users', 'UserManagement::index');
    $routes->get('users/create', 'UserManagement::create');
    $routes->post('users/store', 'UserManagement::store');
    $routes->get('users/(:num)', 'UserManagement::show/$1');
    $routes->get('users/(:num)/edit', 'UserManagement::edit/$1');
    $routes->put('users/(:num)', 'UserManagement::update/$1');
    $routes->delete('users/(:num)', 'UserManagement::delete/$1');
    $routes->post('users/toggle-status/(:num)', 'UserManagement::toggleStatus/$1');

    // Category Management
    $routes->get('categories', 'CategoryManagement::index');
    $routes->get('categories/create', 'CategoryManagement::create');
    $routes->post('categories/store', 'CategoryManagement::store');
    $routes->get('categories/(:num)', 'CategoryManagement::show/$1');
    $routes->get('categories/(:num)/edit', 'CategoryManagement::edit/$1');
    $routes->put('categories/(:num)', 'CategoryManagement::update/$1');
    $routes->delete('categories/(:num)', 'CategoryManagement::delete/$1');
    $routes->post('categories/toggle-status/(:num)', 'CategoryManagement::toggleStatus/$1');
});
