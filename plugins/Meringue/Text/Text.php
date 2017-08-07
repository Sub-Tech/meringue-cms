<?php namespace Plugins\Meringue\Text;


use App\PluginBase;

class Text extends PluginBase
{

    public function __construct()
    {
        $this->vendor = 'Meringue';
        $this->name = 'Text';
    }

    /**
     * Details used for the plugin
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Text',
            'description' => 'Allows you to easily create a text block',
            'author' => 'James Lewis',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * Runs on activate
     */
    public function install() {
        $this->runMigrations();

    }
}
