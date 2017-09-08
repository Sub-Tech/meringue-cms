<?php

namespace App\Http\Requests;

use App\Rules\ParentMustHaveNoParent;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateMenuOption
 * @package App\Http\Requests
 */
class CreateMenuOption extends FormRequest
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
            'href' => ['string', 'required']
        ];
    }

}
