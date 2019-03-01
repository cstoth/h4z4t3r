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
use App\Helpers\Hazater;

/**
 * Class HomeController.
 */
class HomeController extends Controller {
    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return view('frontend.index');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function search(Request $request) {
        session_start();
        //return $this->find($request);
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
    public function findGet(Request $request) {
        return $this->doFind($request);
    }

    /**
     *
     */
    public function findPost(Request $request) {
        return $this->doFind($request);
    }

    /**
     * 
     */
    private function budapest_hack($query, $city_id, $city_id_name, $not = false) {
        if (isset($city_id)) {
            $ids = array($city_id);
            if ($city_id == 3183) { // Budapest
                array_push($ids, 393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415);
            }
            if ($city_id_name == 'end') {
            }
            if ($not) {
                return $query->whereNotIn($city_id_name.'_city_id', $ids);
            } else {
                return $query->whereIn($city_id_name.'_city_id', $ids);
            }
        }
        return $query;
    }

    /**
     * 
     */
    private function getInputCity($request, $name, $default) {
        if (Input::has($name)) {
            return $request->input($name);
        }
        return $default;
    }

    /**
     * 
     */
    public function queryAdvertises($start_city_id, $end_city_id, $date, $name, $type = 0) {
        $query = Advertise::select('*')->selectSub('SELECT '.$type, 'mode')
            ->whereNull('template')->where('status', 1)->where('start_date', '>=', date('Y-m-d H:i:s'))
            ->whereNotNull('start_date')->whereNotNull('end_date');

        if (isset($date) && !empty($date)) {
            $query->whereDate('start_date', '=', $date);
            //$query->where('start_date', '<=', $date)->where('end_date', '>=', $date);
        }

        if (isset($name) && !empty($name)) {
            $query->whereRaw("user_id IN (SELECT id FROM users WHERE LOWER(CONCAT(first_name,' ',last_name)) LIKE LOWER(?))", ["%{$name}%"]);
        }

        // if ($limit > 0) {
        //     $query->take($limit);
        // }

        $query->where(function($query) use($start_city_id, $end_city_id) {
            $this->budapest_hack($query, $start_city_id, 'start');
            if (isset($start_city_id)) {
                $query->orWhereRaw($start_city_id.' IN (SELECT city_id FROM midpoints WHERE advertise_id=advertises.id)');
            }
        });
    
        $query->where(function($query) use($start_city_id, $end_city_id) {
            $this->budapest_hack($query, $end_city_id, 'end');
            if (isset($end_city_id)) {
                $query->orWhereRaw($end_city_id.' IN (SELECT city_id FROM midpoints WHERE advertise_id=advertises.id)');
            }
        });

        //\Log::info('QUERY: ' . Hazater::getQueries($query));
        return $query; //->orderBy('start_date');
    }

    /**
     * 
     */
    public function queryAdvertisesByHere($start_city_id, $end_city_id, $date, $name, $type = 1) {
        if (isset($start_city_id) && isset($end_city_id)) {
            //$route = Hazater::queryRoute($start_city_id, $end_city_id, 'fastest');
            //dd($route);

            $query = Advertise::select('*')->selectSub('SELECT '.$type, 'mode')
                ->whereNull('template')->where('status', 1)->where('start_date', '>=', date('Y-m-d H:i:s'))
                ->whereNotNull('start_date')->whereNotNull('end_date');

            if (isset($date) && !empty($date)) {
                $query->where('start_date', '<=', $date)->where('end_date', '>=', $date);
            }

            if (isset($name) && !empty($name)) {
                $query->whereRaw("user_id IN (SELECT id FROM users WHERE LOWER(CONCAT(first_name,' ',last_name)) LIKE LOWER(?))", ["%{$name}%"]);
            }

            if ($type == 1) {
                $this->budapest_hack($query, $start_city_id, 'start');
            } else {
                $this->budapest_hack($query, $end_city_id, 'end');
            }

            return $query;
        } else {
            return Advertise::select('*')->selectSub('SELECT '.$type, 'mode')->where('status', 999);
        }
    }

    /**
     * @return \Illuminate\View\View
     */
    private function doFind(Request $request) {
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

        $start_city = $this->getInputCity($request, 'searchStartCity', $search['start_city'] ?? "");
        $start_city_id = City::getCityByName($start_city, true);
        $end_city = $this->getInputCity($request, 'searchEndCity', $search['end_city'] ?? "");
        $end_city_id = City::getCityByName($end_city, true);
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

        $response = $this->queryAdvertises($start_city_id, $end_city_id, $date, $name);
        $response1 = $this->queryAdvertisesByHere($start_city_id, $end_city_id, $date, $name, 1);
        $response2 = $this->queryAdvertisesByHere($start_city_id, $end_city_id, $date, $name, 2);
        $response = $response->union($response1)->union($response2)->orderBy('start_date')->paginate(25);

        return view('frontend.search')->withSearch($search)->withResults($response);
        //return redirect()->route('frontend.search')->withResults($response)->withSearch($search);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function howitworks() {
        return view('frontend.howitworks');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function terms() {
        return view('frontend.terms');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function dataprotection() {
        return view('frontend.dataprotection');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function userList() {
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
        session_start();
        $_SESSION['MAIN_MENU_ID'] = $request->input('id');
    }

    public function subMenu(Request $request) {
        session_start();
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
        session_start();
        $tab = $request->input('tab');
        $_SESSION[$tab] = $request->input('hash');
        return $request->input('hash');
    }

    /**
     *
     */
    public function searchTransport(Request $request) {
        $data = null;
        $start_city_id = City::getCityByName($request->input('startCity'));
        $end_city_id = City::getCityByName($request->input('endCity'));
        $advertise = Advertise::find($request->input('advertise'));
        $mode = $request->input('mode');
        if (isset($start_city_id) && isset($end_city_id) && isset($advertise) && isset($mode)) {
            $from = $advertise->end_city_id;
            $to = $end_city_id;
            if ($mode === 2) {
                $from = $start_city_id;
                $to = $advertise->start_city_id;
            }
            $route = Hazater::queryRoute($from, $to, 'fastest');
            // if ($route === false) {
            //     //return response()->json(error_get_last());
            //     return response()->json($route);
            // }
            return response()->json($route);
        }
        return response()->json(null);
    }
}
