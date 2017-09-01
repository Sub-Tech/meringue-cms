<?php

namespace App\Plugin;

use App\Plugin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;

/**
 * Class PluginInitialiser
 */
class PluginInitialiser
{

    /**
     * @var \Illuminate\Support\Collection
     */
    public $plugins;


    /**
     * PluginInitialiser constructor.
     */
    public function __construct()
    {
        $this->plugins = $this->loadAll();
    }


    /**
     * Auto load plugins from the plugins directory.
     *
     * @return \Illuminate\Support\Collection
     */
    public function loadAll()
    {
        foreach ($this->getVendors() as $vendor) {
            $this->initialisePlugins($vendor);
        }

        return collect($this->plugins);
    }


    /**
     * Returns an array of each Vendor in the plugins folder
     *
     * @return array
     */
    private function getVendors()
    {
        return trim_directory_path(scandir(base_path('plugins')));
    }


    /**
     * Initialise all Plugins inside a vendor folder
     *
     * @param $vendor
     */
    private function initialisePlugins(string $vendor)
    {
        foreach ($this->getVendorsPlugins($vendor) as $plugin) {
            $this->initialisePlugin($vendor, $plugin);
        }
    }


    /**
     * Return an array of all a Vendors' Plugins
     *
     * @param string $vendor
     * @return array
     */
    private function getVendorsPlugins(string $vendor)
    {
        return trim_directory_path(scandir(base_path('plugins') . '/' . $vendor));
    }


    /**
     * Initialise the specified Plugin
     *
     * @param string $vendor
     * @param string $plugin
     */
    private function initialisePlugin(string $vendor, string $plugin)
    {
        $filePath = file_path($vendor, $plugin);

        include_once(base_path($filePath));

        try {
            $this->addPluginToArray($vendor, $plugin);
        } catch (ModelNotFoundException $exception) {
            $this->registerPlugin($vendor, $plugin);
        }
    }


    /**
     * Add the current plugin to the array of plugins
     *
     * @param string $vendor
     * @param string $plugin
     */
    private function addPluginToArray(string $vendor, string $plugin)
    {
        $classPath = class_path($vendor, $plugin);

        $this->plugins[$vendor . '/' . $plugin] = (object)array_merge([
            'class' => $classPath,
            'file' => file_path($vendor, $plugin),
            'vendor' => $vendor
        ], Plugin::findOrFail($classPath)->toArray());
    }


    /**
     * Registers a new Plugin
     *
     * @param string $vendor
     * @param string $plugin
     */
    private function registerPlugin(string $vendor, string $plugin)
    {
        $filePath = file_path($vendor, $plugin);
        $classPath = class_path($vendor, $plugin);

        Plugin::create([
            'class_name' => $classPath,
            'file_name' => $filePath,
            'name' => $plugin
        ])->update(
            $this->getPlugin($classPath)->details()
        );

        // This method failing is what calls this function in the first place
        // Now that the plugin has been registered, we can continue adding
        // this plugin to the global array that is called elsewhere...!
        $this->addPluginToArray($vendor, $plugin);
    }


    /**
     * Goes through each Vendor -> Plugin and loads the Routes file
     */
    public function initialiseRoutes()
    {
        foreach ($this->getVendors() as $vendor) {
            foreach ($this->getVendorsPlugins($vendor) as $plugin) {
                $this->loadRoutesFile($vendor, $plugin);
            }
        }
    }


    /**
     * Loads the routes file
     *
     * @param string $vendor
     * @param string $plugin
     */
    private function loadRoutesFile(string $vendor, string $plugin)
    {
        $routesFile = base_path("plugins/{$vendor}/{$plugin}/routes.php");

        if (file_exists($routesFile)) {
            include_once($routesFile);
        }
    }


    /**
     * Initialise the plugin by its Class Path
     * Plugins\Vendor\Plugin\Plugin
     *
     * @param string $class
     * @return PluginBase|PluginInterface|InstanceInterface|CronInterface
     */
    public static function getPlugin(string $class)
    {
        return App::make($class);
    }

}