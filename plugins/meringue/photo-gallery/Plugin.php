<?php namespace Meringue\PhotoGallery;


use App\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Photo Gallery',
            'description' => 'Allows you to easily create a photo gallery',
            'author'      => 'James Lewis',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\October\Demo\Components\Todo' => 'demoTodo'
        ];
    }

    public function registerSideBarMenuItem()
    {
        return [
           'name' => 'Photo Gallery'
        ];
    }
}
