<?php

namespace App;


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

    /**
     * PluginBase constructor.
     */
    public function __construct()
    {
        $this->loadPlugins();
    }


    public function getSideBarMenuItems() {
        foreach($this->plugins as $plugin){
            dd((new $plugin['class']())->registerSideBarMenuItem());
        }


    }

    public function loadPlugins() {
        $vendorDir = base_path('plugins');
        $vendors = scandir(base_path('plugins'));
        unset($vendors[0], $vendors[1]);
        foreach($vendors as $vendor) {
            $plugins = scandir($vendorDir . '/'. $vendor);
            unset($plugins[0], $plugins[1]);
            foreach ($plugins as $plugin) {
                $classPath = "Plugins\\".$vendor."\\".$plugin."\\".$plugin;
                $filePath = "plugins/".$vendor."/".$plugin."/".$plugin.'.php';
                include_once(base_path($filePath));
                $this->plugins[$vendor.'/'.$plugin] = [
                    'class' => $classPath,
                    'file' => $filePath
                ];
            }
        }
    }





}