<?php

namespace Plugins\Meringue\Form;

use Illuminate\View\View;
use Plugins\Meringue\Form\Requests\CreateInput;

/**
 * Class Form
 * @package Plugins\Meringue\Form
 */
class FormBuilder
{

    /**
     * @param Models\Form $form
     * @return View
     */
    public function index(Models\Form $form)
    {
        return view('Meringue/Form/views/builder')
            ->with('inputTypes', Models\Input::types())
            ->with('form', $form);
    }


    /**
     * Create an Input
     *
     * @param CreateInput $request
     * @param Models\Form $form
     */
    public function createInput(CreateInput $request, Models\Form $form)
    {
        $input = $form->inputs()->create(array_merge(
            $request->all(), [
            'name' => label_to_name($request->label),
            'position' => Models\Input::whereFormId($form->id)->count() + 1,
            'required' => $request->has('required') ? 1 : 0
        ]));

        $input->save();
    }


    /**
     * Move an input up or down
     */
    public function updateInputPosition()
    {
        //
    }

}