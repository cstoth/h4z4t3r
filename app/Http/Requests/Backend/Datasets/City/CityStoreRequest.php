<?php

namespace App\Http\Requests\Backend\Datasets\City;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

/**
 * Class CityStoreRequest.
 */
class CityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // TODO $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return City::$rules;
    }
}
