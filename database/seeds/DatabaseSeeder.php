<?php

use Illuminate\Database\Seeder;
use App\User;
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
    
    //    factory(Shipment::class,15)->create();
      
       $this->call(AdminCustomerUserSeeder::class);
       $this->call(ShipmentRateSeeder::class);
    }
}
