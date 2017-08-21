<?php namespace Plugins\Meringue\Text;

use App\InstanceInterface;
use App\PluginBase;
use App\PluginInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class Text
 * @package Plugins\Meringue\Text
 */
class Text extends PluginBase implements PluginInterface, InstanceInterface
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
     * @param null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($instanceId = null)
    {
        $content = DB::table('meringue_text_text')->find($instanceId)->content;

        return view('Meringue/Text/views/text')
            ->with('content', $content);
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
     * #TODO get ckeditor implemented
     *
     * @return array
     */
    public function registerBlock()
    {
        return [
            'inputs' => [ // Inputs for the page editor
                'content' => [ // Key must be same as database column
                    'type' => 'wysiwyg' // This will load a corresponding input in the page editor
                ],
                'name' => [
                    'type' => 'text'
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

    /**
     * Renders the admin panel
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function admin()
    {
        return false;
    }


    /**
     * Get the Text Instance
     *
     * @param int $instanceId
     * @return Collection
     */
    public function getInstance(int $instanceId)
    {
        return DB::table('meringue_text_text')->find($instanceId);
    }


    /**
     * Save an instance of the plugin to the db
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request)
    {
        return DB::table('meringue_text_text')->insertGetId($request->all());
    }
}
