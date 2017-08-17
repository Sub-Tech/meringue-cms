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
        'position',
        'required',
        'options'
    ];

    protected $appends = [
        'form_input_id'
    ];

    /**
     * Identifies each Form Input
     *
     * @return string
     */
    public function getFormInputIdAttribute()
    {
        return "{$this->name}-{$this->id}";
    }

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