<?php

namespace App\Http\Requests\Backend\Datasets\Message;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Messages;

/**
 * Class MessageManageRequest.
 */
class MessageManageRequest extends FormRequest
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
        return Messages::$rules;
    }
}
