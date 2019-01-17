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

class SystemClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans system';

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
        \Log::info($this->signature . " started");

        \Log::info($this->signature . " ended");
    }
}



