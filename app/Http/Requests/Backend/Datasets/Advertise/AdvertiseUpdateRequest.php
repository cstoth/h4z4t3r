<?php

namespace App\Http\Requests\Backend\Datasets\Advertise;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Advertise;

/**
 * Class AdvertiseUpdateRequest.
 */
class AdvertiseUpdateRequest extends FormRequest
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
        return Advertise::$rules;
    }
}
