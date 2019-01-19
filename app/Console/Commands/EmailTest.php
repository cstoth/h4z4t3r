<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Hazater;
use App\Mail\SendHunter;
use App\Mail\SendRate;
use App\Mail\Frontend\SendMail;
use App\Mail\Frontend\SendResign;
use App\Mail\Frontend\SendUpdate;
use App\Mail\Frontend\SendMeUpdate;
use App\Mail\Frontend\SendCancel;
use App\Mail\Frontend\SendMeCancel;
use App\Mail\Frontend\SendDelete;
use App\Mail\Frontend\SendMeDelete;
use App\Mail\Frontend\SendReserve;
use App\Mail\Frontend\SendMeReserve;
use App\Models\Hunter;
use App\Models\Auth\User;
use App\Models\Advertise;
use App\Models\Passanger;
use App\Models\Reserve;

class EmailTest extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test send emails to me';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $output = new ConsoleOutput();

        $user = User::find(48);
        if ($user) {

            $advertise = Advertise::find(1);
            if ($advertise) {
                // Rate
                $output->write("SendRate... ");
                Mail::send(new SendRate($user, $advertise));
                $output->writeln("ok");

                // Advertise
                $output->write("SendUpdate... ");
                Mail::send(new SendUpdate($user, $advertise));
                $output->writeln("ok");

                $output->write("SendMeUpdate... ");
                Mail::send(new SendMeUpdate($user, $advertise));
                $output->writeln("ok");

                // Delete
                $output->write("SendDelete... ");
                Mail::send(new SendDelete($user, $advertise));
                $output->writeln("ok");

                $output->write("SendMeDelete... ");
                Mail::send(new SendMeDelete($user, $advertise));
                $output->writeln("ok");

                // Reserve
                $output->write("SendReserve... ");
                Mail::send(new SendReserve($user, $advertise));
                $output->writeln("ok");

                $output->write("SendMeReserve... ");
                Mail::send(new SendMeReserve($user, $advertise));
                $output->writeln("ok");

                // Cancel
                $output->write("SendCancel... ");
                Mail::send(new SendCancel($user, $advertise));
                $output->writeln("ok");

                $output->write("SendMeCancel... ");
                Mail::send(new SendMeCancel($user, $advertise));
                $output->writeln("ok");

                // Resign
                // $output->write("SendResign... ");
                // Mail::send(new SendResign($user, $advertise));
                // $output->writeln("ok");
            }
        }
    }
}



