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
        'form_id',
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

    public function getAnswersAttribute($value)
    {
        return collect(json_decode($value));
    }

    public function getEmailAttribute($value)
    {
        if (!is_null($value)) {
            return $value;
        }

        $answers = json_decode($this->answers);

        if (isset($answers->email)) {
            return $answers->email;
        }

        return null;
    }

}