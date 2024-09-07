<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('api', function($routes){
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");

    $routes->resource('user', ['filter' => 'authFilter']);
});
    
