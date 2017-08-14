<?php

namespace Plugins\Meringue\Form\Models;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{

    protected $table = 'meringue_form_inputs';

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}