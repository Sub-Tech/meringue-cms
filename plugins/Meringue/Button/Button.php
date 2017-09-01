<?php

namespace Plugins\Meringue\Button;

use App\InstanceInterface;
use App\PluginBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class Button
 * @package Plugins\Meringue\Button
 */
class Button extends PluginBase implements InstanceInterface
{

    /**
     * Set any details necessary to the running of the Plugin
     *
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'Button',
            'description' => 'Allows you to easily create a Button block',
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
        $this->name = 'Button';
    }


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return bool
     */
    public function install()
    {
        return false;
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
        return view('Meringue/Button/views/button')
            ->with('button', Models\Button::find($instanceId));
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'name' => 'Button',
            'description' => 'Choose a Button, nig!',
            'inputs' => [
                'text' => [
                    'type' => 'text'
                ],
                'link' => [
                    'type' => 'text'
                ]
            ]
        ];
    }


    /**
     * Get the specified Instance of the Plugin
     *
     * @param int $instanceId
     * @return Collection|Model|\stdClass
     */
    public function getInstance(int $instanceId)
    {
        return Models\Button::find($instanceId);
    }

    /**
     * Save an instance of the plugin to the db
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int
    {
        return Models\Button::create($request->only(['text', 'link']))->id;
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
        return Models\Button::find($instanceId)
            ->update($request->all());
    }

}