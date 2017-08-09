<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = [
        'class_name', 'file_name', 'active', 'installed', 'name', 'author', 'icon', 'description'
    ];

    protected $primaryKey = 'class_name';

    public $incrementing = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany(Block::class, 'plugin_class', 'class_name');
    }

    public function loadPlugin() {
        return (new $this->class_name());
    }

}
