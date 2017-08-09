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
            'icon' => './assets/images/block-icon.png',
        ];
    }

    /**
     * Runs on activate
     */
    public function install() {
        $this->runMigrations();

    }

    public function registerBlock(){
      return [
          'name' => 'Text',
          'description' => 'Simple text block with WYSWYG',
          'inputs' => [ // Inputs for the page editor
              'content' => [ // Key must be same as database column
                  'type' => 'wyswyg' // This will load a corresponding input in the page editor
              ]
          ]
      ];
    }
}
