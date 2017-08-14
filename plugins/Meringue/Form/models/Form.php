<?php

namespace Plugins\Meringue\Form\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    protected $table = 'meringue_form_forms';

    public function inputs()
    {
        return $this->hasMany(Input::class);
    }

}