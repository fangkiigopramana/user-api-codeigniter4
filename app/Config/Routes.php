<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/(:any)', function(){
    $response = service('response');
        return $response->setStatusCode(200)
                        ->setJSON([
                            'status' => 200,
                            'required' => 'JWT Token',
                            'message' => [
                                'GET /api/users' => 'Get All User List',
                                'GET /api/users/:id' => 'Get User Detail By Id',
                                'POST /api/users' => 'Creat New User',
                                'PATCH /api/users/:id' => 'Update User By Id',
                                'DELETE /api/users/:id' => 'Delete User By Id',
                                'POST /api/register' => 'Register Account',
                                'POST /api/login' => 'Login Account And Get Token',
                            ]

                        ]);
});

