<?php namespace  Plugins\Meringue\YouTubeVideo;


use App\PluginBase;

class YouTubeVideo extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'YouTube Video',
            'description' => 'Allows you to easily display a video hosted on YouTube',
            'author'      => 'James Lewis',
            'icon'        => 'icon-leaf'
        ];
    }


    public function registerSideBarMenuItem()
    {
        return [
           'name' => 'YouTube Videos',
            'icon' => 'fa fa-youtube-play'
        ];
    }
}
