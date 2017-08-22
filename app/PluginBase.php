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


    public function getName()
    {
        return $this->name;
    }

    public function getVendor()
    {
        return $this->vendor;
    }


//    public function cron()
//    {

//    }

}