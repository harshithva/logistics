<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminCustomerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'gurukal',
            'email' => 'admin@gurukal.co.in',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'gurukal',
            'email' => 'user@gurukal.co.in',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'gurukal',
            'email' => 'customer@gurukal.co.in',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
    }
}
