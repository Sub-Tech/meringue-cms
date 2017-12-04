<?php

namespace Plugins\Meringue\Form;

use App\Plugin\InstanceInterface;
use App\Plugin\PluginBase;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * Class Form
 * @package Plugins\Meringue\Form
 */
class Form extends PluginBase implements InstanceInterface
{

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
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     *
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null)
    {
        try {
            return view('Meringue/Form/views/form')
                ->with('form', $this->getInstance($instanceId));
        } catch (ModelNotFoundException $exception) {
            return false;
        }
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
     * Display all forms
     *
     * @return View
     */
    public function index()
    {
        return view('Meringue/Form/views/forms')
            ->with('forms', Models\Form::all());
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
            'name' => 'Forms',
            'options' => [
                ['href' => route('Form.index'), 'text' => 'View All']
            ]
        ];
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'instances' => Models\Form::all()
        ];
    }


    /**
     * Get the specific Form
     *
     * @param int $instanceId
     * @return Collection
     */
    public function getInstance(int $instanceId)
    {
        return Models\Form::findOrFail($instanceId);
    }


    /**
     * Save an instance of the plugin to the db
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int
    {
        return Models\Form::create($request->all())->id;
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
        return Models\Form::find($instanceId)
            ->update($request->all());
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
        return Models\Form::findOrFail($instanceId)->delete();
    }

    /**
     * Return whole HTML string i.e.
     * '<i class="fa fa-picture-o" aria-hidden="true"></i>'
     * @return string
     */
    public function setFontAwesommeIcon(): string
    {
        return '<i class="fa fa-circle-o" aria-hidden="true"></i>';
    }
}