<?php

namespace Plugins\Meringue\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Input
 * @package Plugins\Meringue\Form\Models
 */
class Input extends Model
{

    use SoftDeletes;

    protected $table = 'meringue_form_inputs';

    protected $fillable = [
        'label',
        'type',
        'name',
        'position'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public static function types()
    {
        return [
            'text',
            'textarea',
            'select',
            'checkbox',
            'radio'
        ];
    }

}