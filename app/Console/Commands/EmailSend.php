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
use App\Mail\SendDriver;
use App\Mail\SendPassanger;
use App\Models\Reserve;

class EmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users after the travel finished one hour';

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
     * 
     */
    public function sendMail(Advertise $advertise) {
        $advertise->status = Advertise::FINISHED;
        $advertise->save();
        
        Mail::send(new SendDriver($advertise));
        $reserves = Reserve::where('advertise_id', $advertise->id)->get();
        foreach ($reserves as $reserve) {
            Mail::send(new SendPassanger($advertise, $reserve->user));
        }        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info($this->signature . " started");

        $output = new ConsoleOutput();

        $date = new \DateTime();
        $date->modify('-1 hour');
        $output->writeln($date->format("Y.m.d H:i:s"));

        $advertises = Advertise::whereNull('template')
            //->where('status', 'in', array(Advertise::ACTIVE, Advertise::PROGRESS, Advertise::FINISHED))
            ->where('status', Advertise::PROGRESS)
            ->where('end_date', '<=', $date)
            ->get();
        foreach ($advertises as $advertise) {
            $output->writeln($advertise->id);
            \Log::info($this->signature . " advertise:" . $advertise->id);
            $this->sendMail($advertise);
        }

        \Log::info($this->signature . " ended");
    }
}



