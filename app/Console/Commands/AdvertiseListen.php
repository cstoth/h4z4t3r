<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Helpers\Hazater;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendHunter;
use App\Models\Hunter;
use App\Models\Auth\User;
use App\Models\Advertise;
use App\Models\Passanger;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdvertiseListen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertise:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listens advertises';

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
        //\Log::info($this->signature . " started");

        $output = new ConsoleOutput();
        
        $date = new \DateTime();
        $advertises = Advertise::whereNull('template')
            ->where('status', Advertise::ACTIVE)
            ->where('start_date', '<', $date)
            ->get();
        foreach ($advertises as $advertise) {
            \Log::info($this->signature . " advertise:" . $advertise->id);
            $output->writeln($advertise->id);
            $advertise->status = Advertise::PROGRESS;
            $advertise->save();
        }

        //\Log::info($this->signature . " ended");
    }
}



