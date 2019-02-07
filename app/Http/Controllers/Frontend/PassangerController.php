<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PassangerUpdateRequest;
use App\Models\Passanger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserve;
use App\Models\Hunter;
use App\Helpers\Hazater;

class PassangerController extends Controller {
    /**
     *
     */
    public function gotoTab($tab) {
        if ($tab == "#reserves") {
            $tab = 1;
        } else if ($tab == "#adhunter") {
            $tab = 2;
        }

        $query = Reserve::join('advertises','reserves.advertise_id','=','advertises.id')->select('reserves.*')
        //->where("reserves.user_id", Auth::user()->id)->orderBy('advertises.start_date');
        ->where("reserves.user_id", Auth::user()->id)->orderBy('advertises.status');
        //dd(Hazater::getQueries($query));

        return view('frontend.user.passanger')->with([
            'tab' => $tab,
            'cars' => Auth::user()->cars()->get(),
            'advertises' => Auth::user()->advertises()->get(),
            'reserve' => null,
            'reserved' => false,
            'reserves' => $query->get(),
            'hunter' => new Hunter(),
            'hunters' => Hunter::where("user_id", Auth::user()->id)->get(),
        ]);
    }

    /**
     *
     */
    public function passangerMenu(Request $request) {
        session_start();
        
        //dd($request);
        $tab = 1;

        if (isset($_SESSION["PASSANGER_TAB"])) {
            $tab = $_SESSION["PASSANGER_TAB"];
        }

        return $this->gotoTab($tab);
    }

    /**
     *
     */
    public function list() {
        $data = Passanger::all();
        return view('frontend.user.pages.driver.passangers')->with([
            'passangers' => $data,
        ]);
    }

    // public function search()
    // {
    //     $data = Car::all();
    //     return $data;
    // }

    // public function add()
    // {
    //     return view('cars/add');
    // }

    // public function addPost()
    // {
    //     $model_data = array(
    //         'to_user_id' => Input::get('to_user_id'),
    //         'subject' => Input::get('subject'),
    //         'car' => Input::get('car'),
    //     );
    //     $model_id = Car::insert($model_data);
    //     return redirect('cars')->with('car', 'Cars successfully added');
    // }

    /**
     *
     */
    public function delete($id) {
        $model = Passanger::find($id);
        if ($model) $model->delete();
        return redirect('dashboard')->with('Passanger', 'Passanger deleted successfully.');
    }

    // public function edit($id)
    // {
    //     $data['cars'] = Car::find($id);
    //     return view('cars/edit', $data);
    // }

    // public function editPost()
    // {
    //     $id = Input::get('cars_id');
    //     $model = Car::find($id);

    //     $model_data = array(
    //         'to_user_id' => Input::get('to_user_id'),
    //         'subject' => Input::get('subject'),
    //         'car' => Input::get('car'),
    //     );
    //     $model_id = Car::where('id', '=', $id)->update($model_data);
    //     return redirect('cars')->with('car', 'Cars Updated successfully');
    // }

    // public function view($id)
    // {
    //     $data['cars'] = Car::find($id);
    //     return view('cars/view', $data);

    // }

    /**
     *
     */
    // public function get($id) {
    //     // TODO Auth!
    //     return Passanger::find($id);
    // }

    /**
     *
     */
    // public function set(PassangerUpdateRequest $request) {
    //     // TODO Auth!
    //     return 'ok';
    // }
}
