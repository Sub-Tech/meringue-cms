<?php

namespace App;

/**
 * Interface PluginInterface
 * @package App
 */
interface PluginInterface
{

    /**
     * Set any details necessary to the running of the Plugin
     *
     * @return array
     */
    public function details(): array;


    /**
     * Set the Vendor of the Plugin
     *
     * @return mixed
     */
    public function setVendor();


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName();


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
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function render();

}