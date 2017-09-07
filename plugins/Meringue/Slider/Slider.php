<?php

namespace Plugins\Meringue\Slider;

use App\Plugin\PluginBase;

/**
 * Class Slider
 * @package Plugins\Meringue\Slider
 */
class Slider extends PluginBase
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
     *
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null)
    {
//        $this->requires('Meringue/PhotoGallery');

        return false;
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        // TODO: Implement constructEditorModal() method.
    }

}