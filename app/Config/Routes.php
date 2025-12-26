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
$routes->get('/dashboard', 'Dashboard::index'); // Temporarily remove auth filter for testing
