<?php

namespace Plugins\Meringue\Button\Models;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    protected $table = 'meringue_button_buttons';

    protected $fillable = [
        'text'
    ];
}