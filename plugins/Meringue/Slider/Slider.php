<?php

namespace Plugins\Meringue\Slider;

use App\Plugin\InstanceInterface;
use App\Plugin\PluginBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

/**
 * Class Slider
 * @package Plugins\Meringue\Slider
 */
class Slider extends PluginBase implements InstanceInterface
{
    /**
     * @var string
     */
    public $requires = "Meringue/PhotoGallery";

    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor(): void
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName(): void
    {
        $this->name = 'Slider';
    }


    /**
     * Set any details necessary to the running of the Plugin
     *
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'Slider',
            'description' => 'Create a Slider comprised of two Photo Galleries',
            'author' => 'Jaden Shepherd',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return void|bool
     */
    public function install()
    {
        $this->requires('Meringue/PhotoGallery');
    }


    /**
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     * TODO check counts?
     *
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null)
    {
        /** @var GalleryLink $link */
        $link = GalleryLink::findOrFail($instanceId);

        return View::make('Meringue/Slider/views/slider')
            ->with('mainGallery', $link->mainGallery())
            ->with('navGallery', $link->navigationGallery());
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'instances' => GalleryLink::all()
        ];
    }


    /**
     * Get the specified Instance of the Plugin
     *
     * @param int $instanceId
     * @return Collection|\stdClass|Model
     */
    public function getInstance(int $instanceId)
    {
        return GalleryLink::findOrFail($instanceId);
    }


    /**s
     * Save an instance of the plugin to the db
     * Return the inserted ID
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int
    {
        return GalleryLink::create($request->all())->id;
    }


    /**
     * Update the Instance in the DB and return success via bool
     *
     * @param int $instanceId
     * @param Request $request
     * @return bool
     */
    public function updateInstance(int $instanceId, Request $request): bool
    {
        return GalleryLink::findOrFail($instanceId)->update($request->all());
    }


    /**
     * Delete the Instance from the DB
     * Return success state
     *
     * @param int $instanceId
     * @return bool
     */
    public function deleteInstance(int $instanceId): bool
    {
        return GalleryLink::findOrFail($instanceId)->delete();
    }

}