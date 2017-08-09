<?php

namespace App;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use League\Flysystem\File;
use Mockery\Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;

class PluginBase
{

    /**
     * @var array
     */
    protected $plugins = [];
    protected $vendor = '';
    protected $name = '';

    /**
     * PluginBase constructor.
     */
    public function __construct()
    {
        $this->loadPlugins();
    }


    /**
     * Todo :// Check if this is still in use
     *
     * @return array
     */
    public function getSideBarMenuItems()
    {
        $menu = [];
        $i = 0;
        foreach ($this->plugins as $plugin) {
            $plugin = (new $plugin['class']());
            if (!method_exists($plugin, 'registerSideBarMenuItem')) {
                continue;
            }
            $plugin = $plugin->registerSideBarMenuItem();
            $menu[$i]['name'] = (isset($plugin['name'])) ? $plugin['name'] : '';
            $menu[$i]['icon'] = (isset($plugin['icon'])) ? $plugin['icon'] : '';
            $i++;
        }
        return $menu;
    }

    /**
     * Get the details for the plugin from the database, if this is out of date, run $this->refreshPluginsRegistry();
     *
     * @return array
     */
    public function getPluginsDetails()
    {
        return Plugin::get();
    }

    /**
     * Auto load plugins from the plugins directory.
     *
     */
    public function loadPlugins()
    {
        $vendorDir = base_path('plugins');
        $vendors = scandir(base_path('plugins'));
        unset($vendors[0], $vendors[1]);
        foreach ($vendors as $vendor) {
            $plugins = scandir($vendorDir . '/' . $vendor);
            unset($plugins[0], $plugins[1]);
            foreach ($plugins as $plugin) {
                $classPath = "Plugins\\" . $vendor . "\\" . $plugin . "\\" . $plugin;
                $filePath = "plugins/" . $vendor . "/" . $plugin . "/" . $plugin . '.php';
                include_once(base_path($filePath));
                $this->plugins[$vendor . '/' . $plugin] = [
                    'class' => $classPath,
                    'file' => $filePath
                ];
            }
        }
    }

    /**
     * Registers the plugin in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshPluginsRegistry()
    {
        $newPlugins = 0;

        foreach ($this->plugins as $plugin) {
            // Plugin details as started in the plugins files
            $pluginDetails = (new $plugin['class']())->pluginDetails();
            // Plugin details as stated in the database
            $pluginRegistry = Plugin::find($plugin['class']);

            // If this plugin is already in the database, refresh these details
            if ($pluginRegistry != null) {
                $pluginRegistry->update([
                    'name' => $pluginDetails['name'],
                    'author' => $pluginDetails['author'],
                    'icon' => $pluginDetails['icon'],
                    'description' => $pluginDetails['description'],
                ]);
            } else {
                (new Plugin([
                    'class_name' => $plugin['class'],
                    'file_name' => $plugin['file'],
                    'name' => $pluginDetails['name'],
                    'author' => $pluginDetails['author'],
                    'icon' => $pluginDetails['icon'],
                    'description' => $pluginDetails['description']
                ]))->save();
                $newPlugins++;
            }
        }
        return response()->json(['success' => true, 'message' => 'Number of new plugins found : ' . $newPlugins]);
    }


    /**
     * Registers the plugins block in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshBlockRegistry()
    {
        $newBlocks = 0;

        foreach ($this->plugins as $plugin) {
            // Plugin details as started in the plugins files
            $pluginClass = (new $plugin['class']());
            if (!method_exists($pluginClass, 'registerBlock')) {
                continue;
            }
            // Plugin details as stated in the database
            $blockRegistry = BlockRegistry::find($plugin['class']);

            // If this plugin is already in the database, refresh these details
            if ($blockRegistry != null) {
                $blockRegistry->update([
                    'name' => $pluginClass->registerBlock()['name'],
                    'icon' => $pluginClass->registerBlock()['icon'],
                    'description' => $pluginClass->registerBlock()['description'],
                ]);
            } else {
                (new BlockRegistry([
                    'plugin_class' => $plugin['class'],
                    'name' => $pluginClass->registerBlock()['name'],
                    'icon' => $pluginClass->registerBlock()['icon'],
                    'description' => $pluginClass->registerBlock()['description']
                ]))->save();
                $newBlocks++;
            }
        }
        return response()->json(['success' => true, 'message' => 'Number of new blocks found : ' . $newBlocks]);
    }

    /**
     * Overwrite this function in your plugin, This will run on activate.
     *
     * @return bool
     */
    public function install()
    {
        return false;
    }

    /**
     * Runs the migrations found in the plugins directory
     */
    public function runMigrations()
    {
        Artisan::call('migrate', ['--path' => 'plugins/' . $this->vendor . '/' . $this->name . '/database/migrations/']);
    }


    public function getLogo()
    {
        $pluginFile = base_path('plugins/'.$this->vendor.'/'.$this->name.'/assets/images/block-logo.png');
        $tmpFileName = '/tmp/'. md5($pluginFile);
        $tmpFile = public_path($tmpFileName);
        if(!file_exists($tmpFile) || (time() - filemtime($tmpFile)) > 300) {
            copy($pluginFile, $tmpFile);
        }
        return $tmpFileName;

    }

}