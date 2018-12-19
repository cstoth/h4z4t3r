<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Models\Advertise;
use App\Models\Car;
use App\Models\Passanger;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return redirect()->route('frontend.index');

        // $messages = [];
        // $advertises = [];
        // $passangers = [];
        // $cars = [];

        // if (Auth::check()) {
        //     $msgs = Messages::where('from_user_id', Auth::user()->id);
        //     $unreads = $msgs->where('readed', 0)->count();
        //     $msgs = $msgs->get();
        //     $messages = [
        //         'count' => count($msgs),
        //         'unreads' => $unreads,
        //         'datas' => $msgs,
        //     ];

        //     // TODO: aktuális hirdetés
        //     $ads = Advertise::where('user_id', Auth::user()->id);
        //     // TODO hirdetés átalakítása
        //     $advertises = [
        //         'datas' => $ads->get(),
        //     ];

        //     // TODO saját hirdetések uatasai
        //     $mypassangers = Passanger::where('user_id', Auth::user()->id);
        //     $passangers = [
        //         'datas' => $mypassangers->get(),
        //     ];

        //     $mycars = Car::where('user_id', Auth::user()->id)->get();
        //     $cars = [
        //         'datas' => $mycars,
        //         'default' => count($mycars) > 0 ? $mycars[0] : null, // TODO: felhasználó default autó
        //     ];
        // }

        // // $_SESSION['MAIN_MENU_ID'] = 1;
        // // $_SESSION['SUB_MENU_ID'] = 2;
        // //dd($GLOBALS);

        // return view('frontend.user.dashboard')->with([
        //     'request'       => $request,
        //     'messages'      => $messages,
        //     'advertises'    => $advertises,
        //     'passangers'    => $passangers,
        //     'cars'          => $cars,
        // ]);
    }

}
