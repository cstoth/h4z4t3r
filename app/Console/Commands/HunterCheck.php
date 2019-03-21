<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Hazater;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendHunter;
use App\Models\Hunter;
use App\Models\Auth\User;
use App\Models\Advertise;

class HunterCheck extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hunter:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check advertises by hunters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        \Log::info($this->signature . " started");
        $this->check();
        \Log::info($this->signature . " ended");
    }

    /**
     *
     */
    public static function checkAdvertise(Advertise $advertise) {
        $hunters = Hunter::where('active', 1)->get();
        foreach ($hunters as $hunter) {
            $user = User::find($hunter->user_id);
            if (($advertise->template == null)
                && ($advertise->status == Advertise::ACTIVE)
                && ($advertise->user_id != $hunter->user_id)
                && ($advertise->startCityOrMidpoint($hunter->start_city_id))
                && ($advertise->endCityOrMidpoint($hunter->end_city_id))
                //TODO: dátum vizsgálat
            ) {
                \Log::info($user->email . ' ' . Hazater::routeLabel($advertise->id));
                Mail::send(new SendHunter($user, $advertise));
            }
        }
    }

    /**
     *
     */
    public function check() {
        $hunters = Hunter::where('active', 1)->get();
        foreach ($hunters as $hunter) {
            \Log::debug($hunter->id);
            $user = User::find($hunter->user_id);
            $advertises = Advertise::whereNull('template')
                ->where('status', Advertise::ACTIVE)
                //->whereRaw('updated_at > CURRENT_DATE-1')
                ->whereRaw('(' . $hunter->start_city_id . ' IN (SELECT city_id FROM midpoints WHERE advertise_id=advertises.id) OR (advertises.start_city_id='.$hunter->start_city_id.'))')
                ->whereRaw('(' . $hunter->end_city_id . ' IN (SELECT city_id FROM midpoints WHERE advertise_id=advertises.id) OR (advertises.end_city_id='.$hunter->end_city_id.'))')
                ->orderBy('id');
            \Log::debug(\App\Helpers\Hazater::getQueries($advertises));
            //\Log::info($advertises->count());
            $advertises = $advertises->get();
            //\Log::info($advertises);
            foreach ($advertises as $advertise) {
                \Log::info('HunterCheck.SendMail: ' . $user->email . ' (' . $advertise->id . '): ' . Hazater::routeLabel($advertise->id));
                Mail::send(new SendHunter($user, $advertise));
                sleep(5);
            }
        }
    }
}



