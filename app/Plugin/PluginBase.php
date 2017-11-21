<?php

namespace App\Plugin;

use Artisan;
use App\Facades\PluginInitialiser;

/**
 * Class PluginBase
 * @package App
 */
abstract class PluginBase implements PluginInterface
{
    /**
     * Each Plugin may have behaviour outside of methods provided via interfaces
     * Dependency on other Plugins being installed, for example
     */
    use RequiresPlugins;

    /**
     * @var string The name of the Vendor
     */
    protected $vendor = '';

    /**
     * @var string The name of the Plugin
     */
    protected $name = '';


    /**
     * @var PluginInitialiser
     */
    protected $pluginInitialiser;


    /**
     * PluginBase constructor.
     */
    public function __construct()
    {
        $this->setName();
        $this->setVendor();
    }


    /**
     * Get the Name of the Plugin
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Get the Vendor of the Plugin
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
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
     * Runs the migrations found in the plugins directory
     * @param string|null $path
     */
    public function runMigrations(string $path = null)
    {
        Artisan::call('migrate', [
            '--path' => $path ?? "plugins/{$this->vendor}/{$this->name}/database/migrations"
        ]);
    }


    /**
     * Rolls the migrations found in the plugins directory back
     * @param string|null $path
     */
    public function rollbackMigrations(string $path = null)
    {
        Artisan::call('migrate:reset', [
            '--path' => $path ?? "plugins/{$this->vendor}/{$this->name}/database/migrations"
        ]);
    }

}