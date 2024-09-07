<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $user_model = new User();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $user = $user_model->where('email', $email)->first();
        
        if(is_null($user)) {
            return $this->respond([
                'error' => 'Invalid username or password.'
            ],401);
        }
        
        $password_verify = password_verify($password, $user['password']);
        
        if(!$password_verify) {
            return $this->respond([
                'error' => 'Invalid username or password.'
            ], 401);
        }
        
        $key = getenv("jwt.secret");
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
 
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );
         
        $token = JWT::encode($payload, $key, 'HS256');
 
        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
         
        return $this->respond($response, 200);
    }
}
