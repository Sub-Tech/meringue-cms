<?php

namespace App\Http\Requests;

use App\Rules\OnlyOneHomepage;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePage extends FormRequest
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
            'homepage' => ['boolean', new OnlyOneHomepage],
            'name' => 'required|string',
            'slug' => 'required|string'
        ];
    }

}
