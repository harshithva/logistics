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
            'password' => 'Gurukal123#',
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'customer 1',
            'email' => 'user@gurukal.co.in',
            'password' => '123456',
            'role' => 'employee'
        ]);

        User::create([
            'name' => 'gurukal',
            'email' => 'customer@gurukal.co.in',
            'password' => 'password',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'gurukal',
            'email' => 'swathi@altendorf.in',
            'password' => 'swathi1234',
            'role' => 'vendor'
        ]);
        User::create([
            'name' => 'gurukal',
            'email' => 'test@gurukal.in',
            'password' => 'Gurukal123#',
            'role' => 'customer'
        ]);
    }
}
