<?php

use App\Filters\AuthFilter;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('/api', function($routes){
    $routes->get("/", function() {
        $response = service('response');
        return $response->setStatusCode(200)
                        ->setJSON([
                            'status' => 200,
                            'required' => 'JWT Token',
                            'message' => [
                                'GET /users' => 'Get All User List',
                                'GET /users/:id' => 'Get User Detail By Id',
                                'POST /users' => 'Creat New User',
                                'PATCH /users/:id' => 'Update User By Id',
                                'DELETE /users/:id' => 'Delete User By Id',
                                'POST /register' => 'Register Account',
                                'POST /login' => 'Login Account And Get Token',
                            ]

                        ]);
    });
    
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");

    $routes->resource('users', ['filter' => AuthFilter::class]);
});
    
