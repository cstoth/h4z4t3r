<?php

namespace App\Helpers\General;

use Carbon\Carbon;

/**
 * Class Timezone.
 */
class Timezone
{
    /**
     * @param Carbon $date
     * @param string $format
     *
     * @return Carbon
     */
    public function convertToLocal(Carbon $date, $format = 'Y M j G:i:s') : string
    {
        return $date->setTimezone(auth()->user()->timezone ?? config('app.timezone'))->format($format);
    }

    /**
     * @param $date
     *
     * @return Carbon
     */
    public function convertFromLocal($date) : Carbon
    {
        return Carbon::parse($date, auth()->user()->timezone)->setTimezone('UTC');
    }
}
