<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateMenuOption
 * @package App\Http\Requests
 */
class UpdateMenuOption extends FormRequest
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
            'parent_id' => ['int', new ParentMustHaveNoParent],
            'href' => ['string'],
            'text' => ['string'],
        ];
    }

}
