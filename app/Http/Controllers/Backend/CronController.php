<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

/**
 * Class CronController.
 */
class CronController extends Controller {
    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('backend.cron.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function hunter() {
        return Artisan::call('hunter:check');
    }
}
