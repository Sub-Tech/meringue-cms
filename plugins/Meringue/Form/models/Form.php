<?php

namespace Plugins\Meringue\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Form
 * @package Plugins\Meringue\Form\Models
 */
class Form extends Model
{
    use SoftDeletes;

    protected $table = 'meringue_form_forms';

    protected $guarded = [];

    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

}