<?php

namespace Plugins\SubTech\Staff;

use App\PluginBase,
    App\PluginInterface;

/**
 * Class Staff
 * @package Plugins\SubTech\Staff
 */
class Staff extends PluginBase implements PluginInterface
{

    /**
     * Staff constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setVendor();
        $this->setName();

        $this->view('staff.php');
    }


    /**
     * Set the details of the plugin
     *
     * @return array
     */
    public function setDetails(): array
    {
        return [
            'name' => 'Staff',
            'description' => 'Staff from SubTech',
            'author' => 'Jaden Shepherd',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * Install the plugin
     */
    public function install()
    {
        $this->runMigrations();

        $this->stamp->getUsers();

        // make Guzzle Req to STAMP to get init users
    }


    public function cron()
    {

    }


    /**
     * Register the block
     *
     * @return array
     */
    public function registerBlock()
    {
        return [
            'name' => 'Staff',
            'description' => 'SubTech Staff',
        ];
    }


    /**
     * Set the Vendor
     */
    public function setVendor()
    {
        $this->vendor = 'SubTech';
    }


    /**
     * Set the Name
     */
    public function setName()
    {
        $this->name = 'Staff';
    }



}