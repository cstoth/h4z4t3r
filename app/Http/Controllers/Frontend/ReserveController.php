<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Advertise;
use Illuminate\Support\Facades\Auth;
use App\Models\Hunter;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\SendReserve;
use App\Mail\Frontend\SendMeReserve;

class ReserveController extends Controller
{
    public function getMenuData($tab) {
        return [
            'tab' => $tab,
            'cars' => Auth::user()->cars()->get(),
            'advertises' => Auth::user()->advertises()->get(),
            'reserve' => $this,
            'reserved' => Reserve::where("user_id", Auth::user()->id)->get(),
            'reserves' => Reserve::where("user_id", Auth::user()->id)->get(),
            'hunter' => new Hunter(),
            'hunters' => Hunter::where('user_id', Auth::user()->id)->get(),
        ];
    }

    /**
     *
     */
    public function gotoTab($tab, $flash = null) {
        return view('frontend.user.passanger')->with($this->getMenuData($tab))->withFlashSuccess($flash);
    }

    /**
     *
     */
    public function redirTab($tab, $flash = null) {
        return redirect()->route('frontend.user.passanger.menu')->with($this->getMenuData($tab))->withFlashSuccess($flash);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Reserve::all();
        return view('frontend.reserve.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Input::get('advertise_id');
        if ($id) {
            //TODO: ellenőrizni jelentkezett-e már erre!
            $advertise = Advertise::find($id);
            if ($advertise) {
                $reserve = new Reserve();
                $reserve->user_id = Auth::user()->id;
                $reserve->advertise_id = $id;
                $reserve->save();
                //dd($reserve);
                $advertise->free_seats--;
                $advertise->save();
                Mail::send(new SendReserve($advertise->user, $advertise));
                Mail::send(new SendMeReserve(Auth::user(), $advertise));
            }
            //dd($advertise);
        }
        return $this->gotoTab(1, "Helyfoglalásod rögzítettük!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        return $reserve;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        //dd($reserve);
        if ($reserve->delete()){
            //return true;
        }
        //return view()->route();
        return $this->redirTab(1, "Helyfoglalásod törlésre került!");
    }
}
