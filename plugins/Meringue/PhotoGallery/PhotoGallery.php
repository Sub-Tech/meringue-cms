<?php

namespace Plugins\Meringue\PhotoGallery;

use App\InstanceInterface;
use App\PluginBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Plugins\Meringue\PhotoGallery\Models\Gallery;

/**
 * Class PhotoGallery
 * @package Plugins\Meringue\PhotoGallery
 */
class PhotoGallery extends PluginBase implements InstanceInterface
{

    /**
     * Get the specified Instance of the Plugin
     *
     * @param int $instanceId
     * @return Collection|\stdClass|Model
     */
    public function getInstance(int $instanceId)
    {
        return Models\Gallery::findOrFail($instanceId);
    }


    /**
     * Save an instance of the plugin to the db
     * Return the inserted ID
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int
    {
        return Models\Gallery::create($request->all())->id;
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
        return Models\Gallery::find($instanceId)
            ->update($request->all());
    }


    /**
     * Set any details necessary to the running of the Plugin
     *
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'PhotoGallery',
            'description' => 'Create a Photo Gallery',
            'author' => 'Jaden Shepherd',
            'icon' => './assets/images/block-icon.png',
        ];
    }


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
        $this->name = 'PhotoGallery';
    }


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return void|bool
     */
    public function install()
    {
        $this->runMigrations();
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
        $gallery = Gallery::find($instanceId);

        return app($gallery->class)->render($gallery->images);
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'instances' => Models\Gallery::all()
        ];
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
            'name' => 'Photo Galleries',
            'options' => [
                ['href' => route('PhotoGallery.index'), 'text' => 'View All']
            ]
        ];
    }

}