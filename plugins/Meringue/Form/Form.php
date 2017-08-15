<?php

namespace Plugins\Meringue\Form;

use App\PluginBase;
use App\PluginInterface;
use Illuminate\Http\Request;
use Validator;

/**
 * Class Form
 * @package Plugins\Meringue\Form
 */
class Form extends PluginBase implements PluginInterface
{

    /**
     * Form constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setVendor();
        $this->setName();
    }


    /**
     * Set the plugin details
     *
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'Form',
            'description' => 'Create a Form',
            'author' => 'Jaden Shepherd',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * Sets the Vendor
     */
    public function setVendor()
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Sets the name
     */
    public function setName()
    {
        $this->name = 'Form';
    }


    /**
     * Handle form submission
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handleAjax(Request $request)
    {
        $form = Models\Form::find($request->form_id);

        Validator::validate($request->all(), $form->validation);

        $tits = $form->responses()->create($request->all());

        return response()->json($tits);
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
        return view('Meringue/Form/views/form')
            ->with('form', Models\Form::find(1)); // TODO test id -> make dynamic
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

}