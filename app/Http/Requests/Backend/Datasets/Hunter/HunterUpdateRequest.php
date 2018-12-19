<?php

namespace App\Http\Requests\Backend\Datasets\Hunter;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Hunter;

/**
 * Class HunterUpdateRequest.
 */
class HunterUpdateRequest extends FormRequest
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
        return Hunter::$rules;
    }
}
