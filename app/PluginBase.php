<?php

namespace App;

use App\Helpers\PluginInitialiser;
use Artisan;

/**
 * Class PluginBase
 * @package App
 */
abstract class PluginBase
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
     * @var PluginInitialiser
     */
    protected $pluginInitialiser;


    /**
     * PluginBase constructor.
     */
    public function __construct()
    {
        $this->pluginInitialiser = app(PluginInitialiser::class);

        $this->setName();
        $this->setVendor();
    }


    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public abstract function setVendor(): void;


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public abstract function setName(): void;


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
     */
    public function runMigrations()
    {
        Artisan::call('migrate', ['--path' => "plugins/{$this->vendor}/{$this->name}/database/migrations/"]);
    }

}