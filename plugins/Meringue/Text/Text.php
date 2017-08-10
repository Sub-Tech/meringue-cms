<?php namespace Plugins\Meringue\Text;

use App\PluginBase;
use App\PluginInterface;

class Text extends PluginBase implements PluginInterface
{

    /**
     * Details used for the plugin
     * @return array
     */
    public function setDetails(): array
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

    public function setVendor()
    {
        $this->vendor = 'Meringue';
    }

    public function setName()
    {
        $this->name = 'Text';
    }

    public function setViewsPath()
    {
        $this->views = '';
    }
}
