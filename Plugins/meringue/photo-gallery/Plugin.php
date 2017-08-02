<?php namespace Meringue\PhotoGallery;


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
}
