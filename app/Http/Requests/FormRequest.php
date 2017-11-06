<?php

namespace App\Http\Requests;

/**
 * Class FormRequest
 * @package App\Http\Requests
 */
abstract class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{

    /**
     * Allow Validation on Route Parameters
     *
     * @param  array|mixed $keys
     * @return array
     */
    public function all($keys = null)
    {
        return array_merge(
            parent::all(),
            $this->route()->parameters()
        );
    }

}
