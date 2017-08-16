<?php

namespace Plugins\Meringue\Form;

use App\PluginBase;
use App\PluginInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     *
     * @return void
     */
    public function setVendor(): void
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Sets the name
     *
     * @return void
     */
    public function setName(): void
    {
        $this->name = 'Form';
    }


    /**
     * Handle form submission
     * Tries to find the model, validates the request and saves the given data
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handleAjax(Request $request)
    {
        try {
            $form = Models\Form::findOrFail($request->form_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Request Failed'
            ], 500);
        }

        Validator::validate($request->all(), json_decode($form->validation));

        $success = (new Models\Response())->fill(array_merge(
            $request->all(), [
            'answers' => json_encode($request->except(['vendor', 'plugin']))
        ]))->save();

        return response()->json([
            'success' => $success
        ], $success ? 200 : 500);
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


    /**
     * Renders the admin panel
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|bool
     */
    public function admin()
    {
        return false;
    }

}