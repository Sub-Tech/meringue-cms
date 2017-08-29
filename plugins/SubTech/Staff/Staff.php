<?php

namespace Plugins\SubTech\Staff;

use App\PluginBase;
use App\PluginInterface;
use Illuminate\Http\RedirectResponse;
use Plugins\SubTech\Staff\Libraries\Stamp;
use stdClass;

/**
 * Class Staff
 * @package Plugins\SubTech\Staff
 */
class Staff extends PluginBase implements PluginInterface
{

    use WorksWithStamp;

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
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null)
    {
        $staff = StampUser::all()->groupBy('category');

        return view('SubTech/Staff/views/staff', [
            'staff' => StaffFormatter::format($staff)
        ]);
    }


    /**
     * Renders the admin panel
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function manageStaff()
    {
        return view('SubTech/Staff/views/admin', [
            'staff' => StampUser::all()
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
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'name' => 'Staff',
            'description' => 'SubTech Staff',
        ];
    }


    /**
     * Gets all users from STAMP and saves / updates them as appropriate
     *
     * @return RedirectResponse
     */
    public function refreshStaff()
    {
        $stamp = new Stamp();

        $users = $stamp->getUsers();

        $users->each(function (stdClass $user) {
            StampUser::findOrNew($user->userid)
                ->fill((array)$user)
                ->save();
        });

        $this->checkForInactiveEmployees($users);

        return redirect('admin/plugin/manage/SubTech/Staff');
    }


    /**
     * Register any Admin Menu Items
     *
     * @return array
     */
    public function registerSideBarMenuItem()
    {
        return [
            'icon' => '',
            'name' => 'SubTech Staff',
            'options' => [
                ['href' => "/admin/plugin/manage/{$this->vendor}/{$this->name}", 'text' => 'Manage Staff']
            ]
        ];
    }

}