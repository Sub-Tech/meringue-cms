<?php

namespace Plugins\Meringue\Form\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInput extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'options' => 'required_if:type,radio,checkbox',
            'label' => 'string|required',
            'type' => 'required'
        ];
    }
}
