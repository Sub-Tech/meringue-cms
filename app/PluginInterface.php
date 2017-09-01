<?php

namespace App;

/**
 * Interface PluginInterface
 * @package App
 */
interface PluginInterface
{

    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor(): void;


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName(): void;


    /**
     * Set any details necessary to the running of the Plugin
     *
     * @return array
     */
    public function details(): array;


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return void|bool
     */
    public function install();


    /**
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     *
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null);


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array;

}