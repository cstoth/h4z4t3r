<?php

namespace App\Events\Backend\Datasets\City;

use Illuminate\Queue\SerializesModels;

/**
 * Class CityCreated.
 */
class CityCreated
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
