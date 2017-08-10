<?php

namespace Plugins\SubTech\Staff;

use App\PluginBase,
    App\PluginInterface;
use App\Libraries\Stamp;

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
        include 'autoload.php';

        parent::__construct();

        $this->setVendor();
        $this->setName();

//        $stamp = new Stamp();
//        dd($stamp->getUsers());

//        $this->view('staff.php');
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
     *
     * @return bool|void
     */
    public function install()
    {
        $this->runMigrations();
    }


    /**
     * Refreshes each StampUser from Stamp
     */
    private function refreshStampUsers()
    {
        $stamp = new Stamp();
        $stamp->getUsers()->each(function (\stdClass $user) {
            StampUser::firstOrCreate([
                'userid' => $user->userid
            ], (array)$user)->save();
        });
    }


    public function cron()
    {
        //
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