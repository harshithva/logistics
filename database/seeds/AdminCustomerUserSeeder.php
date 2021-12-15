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
            'email' => 'logistics@gurukal.in',
            'password' => 'Gurukal123#',
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Demo',
            'email' => 'demo@vawebsites.in',
            'password' => 'demo123',
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
            'password' => 'Guru123kal#',
            'role' => 'customer'
        ]);
        User::create([
            'name' => '4manna',
            'email' => '4manna123@gmail.com',
            'password' => '4manna123',
            'role' => 'customer'
        ]);
    }
}
