<?php

namespace App\Controllers;

use App\Models\User;

class Home extends BaseController
{
    
    public function index(){
        return redirect()->to('/api');
    }
}
