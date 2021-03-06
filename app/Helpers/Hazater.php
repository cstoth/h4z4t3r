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

    static public function slugify($text) {
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);
        $text = trim($text, '-');
        $charmap = array(
            'ö' => 'o','Ö' => 'O','ó' => 'o','Ó' => 'O','ő' => 'o','Ő' => 'O',
            'ú' => 'u','Ú' => 'U','ű' => 'u','Ű' => 'U','ü' => 'u','Ü' => 'U','á' => 'a',
            'Á' => 'A','é' => 'e','É' => 'E','í' => 'i','Í' => 'I',
        );

        $text = strtr($text, $charmap);
        $text = strtolower($text);
        $text = preg_replace('#[^-\w]+#', '', $text);
        // if (empty($text)) {
        //     return 'n-a';
        // }
        return $text;
    }

    /**
     * 
     */
    public static function toKm($length) {
        return floor($length / 1000) . ' km ' . floor($length % 1000)  . ' m';
    }

    /**
     * 
     */
    public static function toDuration($duration) {
        return floor($duration / 3600)  . ' óra ' . floor(($duration % 3600) / 60)  . ' perc';
    }

    /**
     * 
     */
    public static function routeToHtml($route) {
        $leg = $route->leg[0];
        $html = '<style>.direction,.length,.street,.next-street,.heading,.station,.line,.destination,.stops,.company{font-weight:bold;}</style>';
        $html .= '<span class="length">Utazás hossza:</span> ' . Hazater::toKm($leg->length) . ', ';
        $html .= '<span class="length">időtartama:</span> ' . Hazater::toDuration($leg->travelTime) . '<br><br>';
        $html .= '<ol style="font-size:0.8em;text-align:left;">';
        foreach ($leg->maneuver as $maneuver) {
            $html .= '<li>' . $maneuver->instruction . '</li>';
        }
        $html .= '</ol>';
        return $html;
    }

    /**
     * 
     */
    public static function getHereAppCode() {
        $here_app_id = getenv('HERE_APP_ID') ?: 'axUZ27L1dhYZQjW2W8NT'; 
        $here_app_code = getenv('HERE_APP_CODE') ?: '4eggOH1Vi4Zkcj0P5cMHFA';
        return "app_id=".$here_app_id."&app_code=".$here_app_code;
    }

    /**
     * 
     */
    public static function queryCityLocation($city) {
        // \Log::debug("---queryCityLocation---");
        $params = Hazater::getHereAppCode()."&searchtext=".Hazater::slugify($city);
        $rest = "https://geocoder.api.here.com/6.2/geocode.json?".$params;
        // \Log::debug($rest);
        $response = file_get_contents($rest);
        //\Log::debug($response);
        $result = json_decode($response)->Response->View[0]->Result[0];
        //\Log::debug($result);
        $coord = $result->Location->DisplayPosition;
        //\Log::debug($coord);
        return $coord->Latitude.",".$coord->Longitude;
    }

    /**
     * 
     */
    public static function makeQueryRouteResult($title, $data, $code) {
        $error = null;
        if ($code === -1) {
            $error = "Nem megfelelő vagy hiányzó HERE App Id és/vagy HERE App Code.";
        } else if ($code === -2) {
            $error = "A jelenlegi beállítások mellett, a HERE adatbázisában nem található tömegközlekedési lehetőség.";
        }
        return [
            'name' => $title,
            'data' => $data,
            'error' => $error,
        ];
    }

    /**
     *
     */
    public static function queryRoute($start_city_id, $end_city_id, $mode = "fastest") {
        // \Log::debug("---queryRoute---");
        $city_start = City::find($start_city_id);
        $city_end = City::find($end_city_id);

        if (isset($city_start) && isset($city_end)) {
            $title = $city_start->name . " -> " . $city_end->name;
            $from = Hazater::queryCityLocation($city_start->name);
            $to = Hazater::queryCityLocation($city_end->name);
            // $from = $city_start->y.",".$city_start->x;
            // $to = $city_end->y.",".$city_end->x;

            $rest = "https://route.api.here.com/routing/7.2/calculateroute.json?".Hazater::getHereAppCode()
                ."&alternatives=0&avoidTransportTypes=&departure=now&jsonAttributes=41&language=hu_HU&metricSystem=metric"
                ."&mode=fastest;publicTransportTimeTable;traffic:disabled&transportMode=publicTransport&walkSpeed=1.4"
                ."&waypoint0=geo!".$from
                ."&waypoint1=geo!".$to;
            \Log::debug($rest);
            $response = @file_get_contents($rest);
            // \Log::debug($response);
            if ($response) {
                if (strpos($response, '"code":"I4"') !== false) {
                    return Hazater::makeQueryRouteResult($title, null, -1);
                }
                if (strpos($response, 'GW0001') !== false) {
                    return Hazater::makeQueryRouteResult($title, null, -2);
                }
                return Hazater::makeQueryRouteResult($title, Hazater::RouteToHtml(json_decode($response)->response->route[0]), null);
            } else {
                return Hazater::makeQueryRouteResult($title, null, -2);
            }
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
