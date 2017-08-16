<?php

namespace Plugins\SubTech\Staff;

use App\PluginBase;
use App\PluginInterface;
use Illuminate\Support\Collection;
use Plugins\SubTech\Staff\Libraries\Stamp;

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
    }


    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor(): void
    {
        $this->vendor = 'SubTech';
    }


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName(): void
    {
        $this->name = 'Staff';
    }


    /**
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function render()
    {
        return view('SubTech/Staff/views/staff', [
            'staff' => StaffFormatter::format($this->getStaff($groupByCategory = true))
        ]);
    }


    /**
     * Render the admin
     */
    public function admin()
    {
        return view('SubTech/Staff/views/staff', [
            'staff' => $this->getStaff()
        ]);
    }

    /**
     * Set the details of the plugin
     *
     * @return array
     */
    public function details(): array
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
     * Get all Staff
     *
     * @param bool $groupByCategory
     * @return Collection
     */
    public function getStaff(bool $groupByCategory = false): ?Collection
    {
        $users = StampUser::all();

        if ($groupByCategory) {
            $users->groupBy('category');
        }

        return $users;
    }


    /**
     * Gets all users from STAMP and saves / updates them as appropriate
     */
    public function refreshStaff()
    {
        $stamp = new Stamp();

        $stamp->getUsers()->each(function (\stdClass $user) {
            StampUser::firstOrCreate($where = ['userid' => $user->userid],
                $values = (array)$user
            )->save();
        });
    }

}