<?php namespace  Plugins\Meringue\YouTubeVideo;


use App\PluginBase;
use App\PluginInterface;

class YouTubeVideo extends PluginBase implements PluginInterface
{

    public function setDetails(): array
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

    public function setVendor(string $vendor)
    {
        // TODO: Implement setVendor() method.
    }

    public function setName(string $name)
    {
        // TODO: Implement setName() method.
    }
}
