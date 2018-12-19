<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Advertise;

class Hazater
{
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
}
