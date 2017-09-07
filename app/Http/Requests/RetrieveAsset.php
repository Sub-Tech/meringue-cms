<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class RetrieveAsset
 * @package App\Http\Requests
 */
class RetrieveAsset extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     * Checks the file type and if it's not in the array, reject it
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $pieces = explode('.', $request->path());

        return in_array(last($pieces), [
            'js',
            'css'
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

}
