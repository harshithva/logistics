<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Agency;
use App\Shipment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       factory(User::class,5)->create();
       factory(Agency::class,15)->create();
       factory(Shipment::class,15)->create();
      
    }
}
