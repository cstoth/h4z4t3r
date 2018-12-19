<?php

use Illuminate\Database\Seeder;
use App\Models\Passanger;

class PassangersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Passanger::create([
            'user_id'      => 1,
            'advertise_id' => 2,
        ]);

        Passanger::create([
            'user_id'      => 1,
            'advertise_id' => 3,
        ]);

        Passanger::create([
            'user_id'      => 2,
            'advertise_id' => 3,
        ]);
    }
}
