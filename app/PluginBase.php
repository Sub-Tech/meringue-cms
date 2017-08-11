<?php

namespace App;

use Illuminate\Support\Facades\Artisan;

/**
 * Class PluginBase
 * @package App
 */
class PluginBase
{

    /**
     * @var array
     */
    protected $plugins = [];

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
            $menu[$i]['name'] = $plugin['name'] ?? '';
            $menu[$i]['icon'] = $plugin['icon'] ?? '';
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

        $this->trimDirectoryPath($vendors);

        foreach ($vendors as $vendor) {
            $plugins = scandir($vendorDir . '/' . $vendor);

            $this->trimDirectoryPath($plugins);

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
     * Removes the '.' and '..' from the directory path
     *
     * @param $pathArray
     */
    public function trimDirectoryPath(&$pathArray)
    {
        unset($pathArray[0], $pathArray[1]);
    }


    /**
     * Registers the plugin in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshPluginsRegistry()
    {
        $newPlugins = 0;

        collect($this->plugins)->each(function ($plugin) use (&$newPlugins) {
            $pluginDetails = $this->initPlugin($plugin['class'])->setDetails();

            $pluginRegistry = Plugin::findOrNew($plugin['class']);

            if (!$pluginRegistry->exists) {
                $pluginRegistry->fill(array_only($plugin, [
                    'class',
                    'file'
                ]));
                $newPlugins++;
            }

            $pluginRegistry->fill(array_only($pluginDetails, [
                'name',
                'author',
                'icon',
                'description',
            ]))->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'Number of new plugins found : ' . $newPlugins
        ]);
    }


    /**
     * Initialise the plugin by its Class Path
     *
     * @param $class
     * @return mixed
     */
    public function initPlugin($class)
    {
        return new $class();
    }


    /**
     * Registers the plugins block in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshBlockRegistry()
    {
        $newBlocks = 0;

        collect($this->plugins)->each(function ($plugin) use (&$newBlocks) {
            $pluginClass = $this->initPlugin($plugin['class']);

            if (!method_exists($pluginClass, 'registerBlock')) {
                return;
            }

            $blockRegistry = BlockRegistry::findOrNew($plugin['class']);

            if (!$blockRegistry->exists) {
                $blockRegistry->plugin_class = $plugin['class'];
                $newBlocks++;
            }

            $blockRegistry->fill([
                'name' => $pluginClass->registerBlock()['name'],
                'icon' => $pluginClass->registerBlock()['icon'] ?? null,
                'description' => $pluginClass->registerBlock()['description'],
            ])->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'Number of new blocks found : ' . $newBlocks
        ]);
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
     * @param string $view
     */
    public function view(string $view)
    {
        echo file_get_contents(base_path("plugins/{$this->vendor}/{$this->name}/views/" . $view));
    }


}