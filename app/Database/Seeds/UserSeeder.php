<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'darth',
            'email'    => 'darth@theempire.com',
            'password'    => password_hash('darth123', PASSWORD_DEFAULT),
        ];

        // Simple Queries
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name:, :email:, :password:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
