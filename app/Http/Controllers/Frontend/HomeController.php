<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\City;
use App\Models\Advertise;
use \Datetime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        //return $this->find($request);
        session_start();
        if (isset($_SESSION['SEARCH'])) {
            $search = $_SESSION['SEARCH'];
        } else {
            $search = [
                'start_city' => null,
                'start_city_id' => null,
                'end_city' => null,
                'end_city_id' => null,
                'date' => null,
                'name' => null,
            ];
        }
        return view('frontend.search')->withResults([])->withSearch($search);
    }


    /**
     * @return \Illuminate\View\View
     */
    public function findGet(Request $request)
    {
        return $this->innerFind($request);
    }

    /**
     *
     */
    public function findPost(Request $request)
    {
        return $this->innerFind($request);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function innerFind(Request $request)
    {
        //dd($request);
        session_start();
        if (isset($_SESSION['SEARCH'])) {
            $search = $_SESSION['SEARCH'];
        } else {
            $search = [
                'start_city' => null,
                'start_city_id' => null,
                'end_city' => null,
                'end_city_id' => null,
                'date' => null,
                'name' => null,
            ];
        }

        if (Input::has('searchStartCity')) {
            $start_city = $request->input('searchStartCity');
        } else {
            $start_city = $search['start_city'] ?? "";
        }
        $start_city_id = City::getCityByName($start_city);

        if (Input::has('searchEndCity')) {
            $end_city = $request->input('searchEndCity');
        } else {
            $end_city = $search['end_city'] ?? "";
        }
        $end_city_id = City::getCityByName($end_city);

        $date = str_replace('.', '-', $request->input('searchDate'));
        $name = $request->input('searchName');

        $search = [
            'start_city' => $start_city,
            'start_city_id' => $start_city_id,
            'end_city' => $end_city,
            'end_city_id' => $end_city_id,
            'date' => $date,
            'name' => $name,
        ];
        $_SESSION['SEARCH'] = $search;

        $res = Advertise::whereNull('template')->where('status', 1)->where('start_date', '>=', date('Y-m-d H:i:s'));
        $res = $res->whereNotNull('start_date');
        $res = $res->whereNotNull('end_date');
        if (isset($start_city_id)) {
            $res = $res->where('start_city_id', $start_city_id);
        }
        if (isset($end_city_id)) {
            $res = $res->where('end_city_id', $end_city_id);
        }
        if (isset($date) && !empty($date)) {
            $res = $res->where('start_date', '<=', $date)->where('end_date', '>=', $date);
        }
        if (isset($name) && !empty($name)) {
            $res = $res->whereRaw("user_id IN (SELECT id FROM users WHERE LOWER(CONCAT(first_name,' ',last_name)) LIKE LOWER(?))", ["%{$name}%"]);
        }
        $res = $res->orderBy('start_date');
        //dd($res->toSql());
        //dd($res->getBindings());
        //\Log::info('SEARCH '.$res->toSql()); //.' '.$res->getBindings());

        $response = $res->paginate(25);

        return view('frontend.search')->withResults($response)->withSearch($search);
        //return redirect()->route('frontend.search')->withResults($response)->withSearch($search);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function howitworks()
    {
        return view('frontend.howitworks');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function terms()
    {
        return view('frontend.terms');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function dataprotection()
    {
        return view('frontend.dataprotection');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function userList()
    {
        // TODO unset key from array
        return User::all();
        //return User::all('id', 'full_name');
    }

    /**
     *
     */
    public function typeaheadCity(Request $request) {
        $data = City::select("name")
            ->where("name", "LIKE", "%{$request->input('query')}%")
            ->get();
        return response()->json($data);
    }

    /**
     *
     */
    public function typeaheadName(Request $request) {
        $sql = "SELECT CONCAT(first_name,' ',last_name) as name FROM users WHERE LOWER(CONCAT(first_name,' ',last_name)) LIKE LOWER('%{$request->input('query')}%')";
        $data = DB::select(DB::raw($sql));
        return response()->json($data);
    }

    public function mainMenu(Request $request) {
        $_SESSION['MAIN_MENU_ID'] = $request->input('id');
    }

    public function subMenu(Request $request) {
        $_SESSION['SUB_MENU_ID'] = $request->input('id');
    }

    // SELECT * FROM `advertises` WHERE template is null and start_city_id=1 and end_city_id=1 and start_date<='2018-11-05' and end_date>='2018-11-05'
    public function searchAdvertise(Request $request) {
        $start_city_id = City::getCityByName($request->input('startCity'));
        $end_city_id = City::getCityByName($request->input('endCity'));
        $date = str_replace('.', '-', $request->input('date'));
        // $response = ['a'=>$start_city_id,'b'=>$end_city_id,'c'=>$date];
        $response = Advertise::whereNull('template')
            ->where('start_city_id', $start_city_id)
            ->where('end_city_id', $end_city_id)
            ->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->get();
        $response = Advertise::all();
        return response()->json($response);
    }

    public function setTab(Request $request) {
        $tab = $request->input('tab');
        $_SESSION[$tab] = $request->input('hash');
        return $request->input('hash');
    }
}
