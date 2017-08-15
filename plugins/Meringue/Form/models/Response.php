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

    protected $fillable = [
        'answers'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

}