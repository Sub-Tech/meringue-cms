<?php

namespace Plugins\Meringue\Form;

use App\PluginBase;
use App\PluginInterface;

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
    public function setDetails(): array
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
     *
     */
    public function render()
    {
        require __DIR__ . '/Models/Form.php';
        require __DIR__ . '/Models/Input.php';

        return view('Meringue/Form/views/form', [
            'form' => Models\Form::find(1)
        ]);
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

}