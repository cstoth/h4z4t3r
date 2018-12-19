<?php

use Illuminate\Database\Seeder;
use App\Models\Reserve;

class ReservesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reserve::create([
            'user_id'      => 1,
            'advertise_id' => 2,
        ]);

        Reserve::create([
            'user_id'      => 1,
            'advertise_id' => 3,
        ]);

        Reserve::create([
            'user_id'      => 2,
            'advertise_id' => 3,
        ]);
    }
}
