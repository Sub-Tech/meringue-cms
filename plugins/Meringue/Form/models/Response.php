<?php

namespace Plugins\Meringue\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Response
 * @package Plugins\Meringue\Form\Models
 */
class Response extends Model
{

    use SoftDeletes;

    protected $table = 'meringue_form_responses';

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}