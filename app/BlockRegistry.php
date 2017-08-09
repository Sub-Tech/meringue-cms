<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockRegistry extends Model
{
    protected $fillable = [
        'plugin_class', 'name', 'description', 'icon', 'inputs'
    ];
    protected $primaryKey = 'plugin_class';
    public $incrementing = false;

    public function plugin(){
        return $this->belongsTo(Plugin::class, 'plugin_name', 'class_name');
    }



}
