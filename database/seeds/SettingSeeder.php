<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'shipment_id' => 200,
        ]);
    }
}
