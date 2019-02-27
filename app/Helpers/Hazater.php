<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Advertise;
use App\Models\City;
use App\Models\Rate;
use App\Models\Reserve;
use GuzzleHttp\Client;

class Hazater {
    public static function now($format = "Y.m.d H:i:s") {
        return date($format);
    }

    public static function cityName($city_id) {
        $city = DB::table('cities')->where('id','=',$city_id)->first();
        return $city->name;
    }

    public static function formatDate($date, $format = "Y.m.d H:i") {
        try {
            if ($date) {
                $d = date_create($date);
                if (gettype($d) == "boolean") {
                    Hazater::now($format);
                }
                return date_format($d, $format);
            }
        } catch (Exception $e) {
            \Log::info('ERROR: ' . $e->getMessage());
        }
        return Hazater::now($format);
    }

    public static function formatDate2($date, $mode = 0) {
        if ($date == "NaN-NaN-NaN") return null;
        if ($date == "NaN.NaN.NaN") return null;
        //dd($date);
        if ($date) {
            return date_format(date_create($date), "Y.m.d");
        }
        if ($mode == 1) return null;
        return date("Y.m.d");
    }

    public static function routeLabel($advertise_id) {
        $advertise = Advertise::find($advertise_id);
        if ($advertise) {
            $start_city = Hazater::cityName($advertise->start_city_id);
            $end_city = Hazater::cityName($advertise->end_city_id);
            $date = Hazater::formatDate($advertise->start_date);
            return $start_city . " -> " . $end_city . " " . $date;
        } else {
            return $advertise_id;
        }
    }

    public static function isLocal() {
        $env = getenv('APP_ENV') ?? 'local';
        return ($env == 'local');
    }

    public static function makeUrl($path) {
        if (Hazater::isLocal()) {
            return url($path);
        } else {
            $url = url($path);
            $url = str_replace("/public/storage/", "/storage/app/public/", $url);
            return $url;
        }
    }

    public static function callAPI($method, $url, $data){
        $curl = curl_init();

        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'APIKEY: 111111111111111111111',
           'Accept: application/json',
           'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
     }

    // public static function isCityAllowed($city) {
    //     $c = strtoupper($city);
    //     return $c === "BUDAPEST" || $c === "DEBRECEN"
    // }

    /**
     *
     */
    public static function queryRoute($start_city_id, $end_city_id, $mode = "fastest") {
        $city_start = City::find($start_city_id);
        $city_end = City::find($end_city_id);

        if (isset($city_start) && isset($city_end)) {
            $from = $city_start->y.",".$city_start->x;
            $to = $city_end->y.",".$city_end->x;

            //route.api.here.com/routing/7.2/calculateroute.json?app_id=axUZ27L1dhYZQjW2W8NT&app_code=4eggOH1Vi4Zkcj0P5cMHFA&waypoint0=geo!52.5,13.4&waypoint1=geo!52.5,13.45&mode=fastest;car;traffic:disabled
            //transit.api.here.com/v3/route.json?app_id=axUZ27L1dhYZQjW2W8NT&app_code=4eggOH1Vi4Zkcj0P5cMHFA&routing=all&dep=46.07309,18.22876&arr=47.49973,19.05508&time=2019-06-24T07%3A30%3A00
            //Budapest, Debrecen, Kecskemet, Miskolc, Pecs
            $rest = "http://transit.api.here.com/v3/route.json"
                ."?app_id=".getenv('HERE_APP_ID')
                ."&app_code=".getenv('HERE_APP_CODE')
                ."&routing=all"
                ."&lang=hu"
                ."&max=1"
                ."&dep=".$from
                ."&arr=".$to
                ."&time=".Hazater::now("Y-m-dTH:i:s");
//                ."&time=2019-01-31T07:30:00";
            $response = file_get_contents($rest);
            if (strpos($response, 'GW0001') !== false) {
                return "A jelenlegi beállítások mellett, a HERE adatbázisában nem található tömegközlekedési lehetőség.";
            }
            //$obj = json_decode($response);
            //dd($obj);
            $res[] = [
                'name' => $city_start->name . " -> " . $city_end->name,
                'data' => json_decode($response),
            ];
            return json_encode($res);
        }

        return null;
    }

    /**
     *
     */
    public static function isUserNotRated($advertise_id, $user_id) {
        $cnt = Rate::where('user_id', $user_id)->where('advertise_id', $advertise_id)->count();
        return ($cnt == 0);
    }

    /**
     *
     */
    public static function getUserRate($advertise_id, $user_id) {
        $rate = Rate::where('user_id', $user_id)->where('advertise_id', $advertise_id)->first();
        return $rate;
    }

    /**
     *
     */
    public static function isRated($advertise_id) {
        $cntRate = Rate::where('advertise_id', $advertise_id)->count();
        $cntPassanger = Reserve::where('advertise_id', $advertise_id)->count();
        return $cntRate == ($cntPassanger + 1);
    }

    /**
     *
     */
    public static function getQueries($builder) {
        return vsprintf(str_replace('?', '%s', str_replace('?', "'?'", $builder->toSql())), $builder->getBindings());
    }
}
