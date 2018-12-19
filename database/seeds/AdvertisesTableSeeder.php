<?php

use Illuminate\Database\Seeder;
use App\Models\Advertise;

class AdvertisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertise::create([
            'user_id'       => 1,
            'car_id'        => 1,
            'template'      => 'minta',
            'regular'       => 0,
            'start_city_id' => 10,
            'end_city_id'   => 20,
            'start_date'    => '2018.01.01',
            'end_date'      => '2018.01.02',
        ]);

        Advertise::create([
            'user_id'       => 1,
            'car_id'        => 1,
            //'template'     => 'minta',
            'regular'       => 0,
            'start_city_id' => 30,
            'end_city_id'   => 40,
            'start_date'    => '2018.02.01',
            'end_date'      => '2018.02.02',
        ]);

        Advertise::create([
            'user_id'      => 1,
            'car_id'       => 2,
            //'template'     => 'minta',
            //'regular'      => 0,
            'start_city_id' => 50,
            'end_city_id'   => 60,
            'start_date'    => '2018.02.01',
            'end_date'      => '2018.02.02',
        ]);
    }
}
