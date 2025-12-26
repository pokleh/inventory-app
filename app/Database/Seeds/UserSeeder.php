<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@inventory.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'name' => 'Administrator',
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'manager',
                'email' => 'manager@inventory.com',
                'password' => password_hash('manager123', PASSWORD_DEFAULT),
                'name' => 'Manager',
                'role' => 'manager',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user',
                'email' => 'user@inventory.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'name' => 'User',
                'role' => 'user',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);
    }
}
