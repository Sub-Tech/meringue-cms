<?php

namespace App\Helpers;

/**
 * Class PluginInitialiser
 */
class PluginInitialiser
{

    /**
     * @var array Loaded Plugins
     */
    protected $plugins = [];


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
        $filePath = get_plugin_file_path($vendor, $plugin);
        include_once(base_path($filePath));

        load_autoload($vendor, $plugin);

        $this->plugins[$vendor . '/' . $plugin] = (object)[
            'class' => "Plugins\\" . $vendor . "\\" . $plugin . "\\" . $plugin,
            'file' => $filePath
        ];
    }


    /**
     * Initialise the plugin by its Class Path
     *
     * @param $class
     * @return mixed
     */
    public static function getPlugin($class)
    {
        return new $class();
    }

}