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
        include 'autoload.php';

        parent::__construct();

        $this->setVendor();
        $this->setName();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        require __DIR__ . '/StampUser.php';

        return view('SubTech/Staff/views/staff', [
            'staff' => StampUser::all()->groupBy('category')
        ]);
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