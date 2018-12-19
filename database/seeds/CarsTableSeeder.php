<?php

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'user_id'   => 1,
            'license'   => 'ABC-123',
            'brand'     => 'Lada',
            'type'      => 'Lada 1200',
            'seats'     => 5,
            'color'     => 'piros',
            'year'      => 1970,
        ]);

        Car::create([
            'user_id'   => 1,
            'license'   => 'DEF-456',
            'brand'     => 'Ford',
            'type'      => 'Ford kupé',
            'seats'     => 2,
            'color'     => 'sárga',
            'year'      => 2010,
        ]);
    }
}
