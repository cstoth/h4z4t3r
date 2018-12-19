<?php

namespace App\Events\Backend\Datasets\City;

use Illuminate\Queue\SerializesModels;

/**
 * Class CityUpdated.
 */
class CityUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $city;

    /**
     * @param $city
     */
    public function __construct($city)
    {
        $this->city = $city;
    }
}
