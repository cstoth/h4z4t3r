<?php

use Illuminate\Database\Seeder;
use App\Models\Messages;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Messages::create([
            'from_user_id'      => 1,
            'to_user_id'        => 2,
            'subject'           => 'Tárgy',
            'message'           => 'Üzenet',
            'readed'            => 0,
            'advertise_id'      => 1,
        ]);

        Messages::create([
            'from_user_id'      => 2,
            'to_user_id'        => 3,
            'subject'           => 'Tárgy',
            'message'           => 'Üzenet',
            'readed'            => 1,
            'advertise_id'      => 1,
        ]);

        Messages::create([
            'from_user_id'      => 3,
            'to_user_id'        => 1,
            'subject'           => 'Tárgy',
            'message'           => 'Üzenet',
            'readed'            => 0,
            'advertise_id'      => 1,
        ]);
    }
}
