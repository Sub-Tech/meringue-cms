<?php

namespace App\Helpers;

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
    private function initialisePlugins($vendor)
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

        $this->loadAutoload($vendor, $plugin);

        $this->plugins[$vendor . '/' . $plugin] = (object)[
            'class' => class_path($vendor, $plugin),
            'file' => $filePath
        ];
    }


    /**
     * Load the autoload file, if it finds one
     * TODO update with composer autoloading
     *
     * @param string $vendor
     * @param string $plugin
     */
    private function loadAutoload(string $vendor, string $plugin)
    {
        $autoloadFile = base_path("plugins/{$vendor}/{$plugin}/autoload.php");

        if (file_exists($autoloadFile)) {
            include_once($autoloadFile);
        }
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
     * @return object
     */
    public static function getPlugin(string $class)
    {
        return new $class();
    }

}