<?php

namespace App;

use Illuminate\Support\Facades\Artisan;
use App\Helpers\PluginInitialiser;

/**
 * Class PluginBase
 * @package App
 */
class PluginBase
{

    /**
     * @var string The name of the Vendor
     */
    protected $vendor = '';

    /**
     * @var string The name of the Plugin
     */
    protected $name = '';

    /**
     * @var string The route to the views folder
     */
    protected $views = '';

    /**
     * @var PluginInitialiser
     */
    protected $pluginInitialiser;


    /**
     * PluginBase constructor.
     */
    public function __construct()
    {
        $this->pluginInitialiser = app(PluginInitialiser::class);
    }


    /**
     * Refreshes the Plugin Registry
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshPluginsRegistry()
    {
        $newPlugins = 0;

        $this->pluginInitialiser->plugins->each(function ($plugin) use (&$newPlugins) {
            $newPlugins += $this->registerNewPlugin($plugin, $newPlugins);
        });

        return response()->json([
            'success' => true,
            'message' => 'Number of new plugins found : ' . $newPlugins
        ]);
    }


    /**
     * Registers the plugins block in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshBlockRegistry()
    {
        $newBlocks = 0;

        $this->pluginInitialiser->plugins->each(function ($plugin) use (&$newBlocks) {
            $newBlocks += $this->registerNewBlock($plugin, $newBlocks);
        });

        return response()->json([
            'success' => true,
            'message' => 'Number of new blocks found : ' . $newBlocks
        ]);
    }


    /**
     * Register a new Plugin
     *
     * @param $plugin
     * @param $newPlugins
     * @return mixed
     */
    private function registerNewPlugin($plugin, $newPlugins)
    {
        $pluginClass = PluginInitialiser::getPlugin($plugin->class);

        $pluginRegistry = Plugin::findOrNew($plugin->class);

        if (!$pluginRegistry->exists) {
            $pluginRegistry->fill([
                'class_name' => $plugin->class,
                'file_name' => $plugin->file,
                'vendor' => $plugin->vendor
            ]);
            $newPlugins++;
        }

        $pluginRegistry->fill($pluginClass->details())->save();

        return $newPlugins;
    }


    /**
     * Register a new Block
     *
     * @param $plugin
     * @param $newBlocks
     * @return mixed
     */
    private function registerNewBlock($plugin, $newBlocks)
    {
        $pluginClass = PluginInitialiser::getPlugin($plugin->class);

        if (!method_exists($pluginClass, 'registerBlock')) {
            return $newBlocks;
        }

        $blockRegistry = BlockRegistry::findOrNew($plugin->class);

        if (!$blockRegistry->exists) {
            $blockRegistry->plugin_class = $plugin->class;
            $newBlocks++;
        }

        $blockRegistry->fill($pluginClass->registerBlock())->save();

        return $newBlocks;
    }


    /**
     * Runs the migrations found in the plugins directory
     */
    public function runMigrations()
    {
        Artisan::call('migrate', ['--path' => 'plugins/' . $this->vendor . '/' . $this->name . '/database/migrations/']);
    }


    /**
     * Get the plugin's logo
     *
     * @return string
     */
    public function getLogo()
    {
        $pluginFile = base_path('plugins/' . $this->vendor . '/' . $this->name . '/assets/images/block-logo.png');
        $tmpFileName = '/tmp/' . md5($pluginFile);
        $tmpFile = public_path($tmpFileName);
        if (!file_exists($tmpFile) || (time() - filemtime($tmpFile)) > 300) {
            copy($pluginFile, $tmpFile);
        }

        return $tmpFileName;
    }


    /**
     * Todo :// Check if this is still in use
     * TODO it is.
     *
     * @return array
     */
    public function getSideBarMenuItems()
    {
        $menu = [];

        foreach ($this->pluginInitialiser->plugins as $plugin) {
            $pluginClass = $this->pluginInitialiser->getPlugin($plugin->class);

            if (!method_exists($pluginClass, 'registerSideBarMenuItem')) {
                continue;
            }

            $plugin = $pluginClass->registerSideBarMenuItem();

            $menu[] = [
                'name' => $plugin['name'] ?? '',
                'icon' => $plugin['icon'] ?? ''
            ];
        }

        return $menu;
    }


//    public function cron()
//    {

//    }

}