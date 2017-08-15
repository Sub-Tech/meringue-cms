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
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor(): void
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName(): void
    {
        $this->name = 'Text';
    }


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return void|bool
     */
    public function install()
    {
        $this->runMigrations();
    }


    /**
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function render()
    {
        return view('Meringue/Text/views/text');
    }


    /**
     * Details used for the plugin
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'Text',
            'description' => 'Allows you to easily create a text block',
            'author' => 'James Lewis',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * @return array
     */
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


    /* Disabled for now
    public function cron(Schedule $schedule) {
        $schedule->call(function () {
            echo "efe";
        })->everyMinute();
    } */

}
