<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Advertise;
use App\Models\City;
use App\Models\Rate;
use App\Models\Reserve;

class Hazater {
    public static function now($format = "Y.m.d H:i:s") {
        return date($format);
    }

    public static function cityName($city_id) {
        $city = DB::table('cities')->where('id','=',$city_id)->first();
        return $city->name;
    }

    public static function formatDate($date) {
        if ($date) {
            return date_format(date_create($date), "Y.m.d H:i");
        }
        return date("Y.m.d H:i");
    }

    public static function formatDate2($date) {
        if ($date) {
            return date_format(date_create($date), "Y.m.d");
        }
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

    /**
     * 
     */
    public static function queryRoute($start_city_id, $end_city_id, $mode = "fastest") {
        $city_start = City::find($start_city_id);
        $city_end = City::find($end_city_id);
        if ($city_start && $city_end) {
            $from = "waypoint0=geo!".$city_start->y.",".$city_start->x;
            $to = "waypoint1=geo!".$city_end->y.",".$city_end->x;
            // $from = "waypoint0=geo!52.5,13.4";
            // $to = "waypoint1=geo!52.5,13.45";

            //https://route.api.here.com/routing/7.2/calculateroute.json?app_id=axUZ27L1dhYZQjW2W8NT&app_code=4eggOH1Vi4Zkcj0P5cMHFA&waypoint0=geo!52.5,13.4&waypoint1=geo!52.5,13.45&mode=fastest;car;traffic:disabled
            $rest = "https://route.api.here.com/routing/7.2/calculateroute.json?app_id=".getenv('HERE_APP_ID')."&app_code=".getenv('HERE_APP_CODE')."&".$from."&".$to."&mode=".$mode.";publicTransport&combineChange=true";
            $response = file_get_contents($rest);
            $response = json_decode($response);
            return $response;
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
        $rate = Rate::where('user_id', $user_id)->where('advertise_id', $advertise_id)->value('rate');
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
}
