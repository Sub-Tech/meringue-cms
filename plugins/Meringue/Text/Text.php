<?php namespace Plugins\Meringue\Text;

use App\PluginBase;
use App\PluginInterface;

/**
 * Class Text
 * @package Plugins\Meringue\Text
 */
class Text extends PluginBase implements PluginInterface
{

    /**
     * Text constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setVendor();
        $this->setName();
    }


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
     * Set the Vendor
     */
    public function setVendor()
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Set the Name
     */
    public function setName()
    {
        $this->name = 'Text';
    }


    /**
     * Runs on activate
     */
    public function install()
    {
        $this->runMigrations();
    }

    public function registerBlock()
    {
        return [
            'name' => 'Text',
            'description' => 'Simple text block with WYSWYG',
            'inputs' => [ // Inputs for the page editor
                'content' => [ // Key must be same as database column
                    'type' => 'wysiwyg' // This will load a corresponding input in the page editor
                ]
            ]
        ];
    }


    /**
     * Return HTML of the block
     *
     * @return string
     */
    public function render()
    {
        return "<div style='height: 100px; background-color: cyan'><h2>Big milky titties</h2></div>";
    }

}
