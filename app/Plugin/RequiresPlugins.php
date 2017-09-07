<?php

namespace App\Plugin;

/**
 * Trait RequiresPlugins
 * @package App\Plugin
 */
trait RequiresPlugins
{

    /**
     * Check to see if a required plugin exists
     * Pass Vendor/Plugin or separately.
     *
     * @param string $vendor
     * @param string $plugin
     * @throws \Exception
     */
    public function requires(string $vendor, string $plugin = null)
    {
        if (str_contains($vendor, '/')) {
            $pieces = explode('/', $vendor);
            $vendor = $pieces[0];
            $plugin = $pieces[1];
        }

        /** @var PluginBase $this */
        if (!$this->pluginInitialiser->plugins->has(class_path($vendor, $plugin))) {
            throw new \Exception("Required Plugin {$vendor}/{$plugin} doesn't exist or is not activated");
        }
    }

}