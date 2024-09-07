<?php

namespace App\Controllers;

use App\Models\User;
use Config\Services;

class Home extends BaseController
{
    public function index()
    {
        $data['users'] = [
            [
                'name' => 'Wahyu',
                'email' => 'wahyu12@gmail.com',
            ],
            [
                'name' => 'Budi',
                'email' => 'budi34@gmail.com',
            ]
        ];
        return view('home', $data);
    }

    public function createUser(){
        $validation = Services::validation();

        $rules = [
            'name' => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {
            
            $newUser = new User();
        }
    }
}
