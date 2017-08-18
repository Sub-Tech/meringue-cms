<?php

namespace Plugins\Meringue\Form;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Plugins\Meringue\Form\Requests\CreateInput;

/**
 * Class Form
 * @package Plugins\Meringue\Form
 */
class FormBuilder
{

    /**
     * Display the form of which to create a new form.
     * Formception.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('Meringue/Form/views/new');
    }


    /**
     * Create the Form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $form = Models\Form::create($request->all());

        return redirect(route('Form.edit', [
            'form' => $form->fresh()->id
        ]));
    }


    /**
     * Show the GUI to build the form
     *
     * @param Models\Form $form
     * @return View
     */
    public function edit(Models\Form $form)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInput(CreateInput $request, Models\Form $form)
    {
        $input = $form->inputs()->create(array_merge(
            $request->all(), [
            'name' => label_to_name($request->label),
            'position' => Models\Input::whereFormId($form->id)->count() + 1,
            'options' => json_encode(explode($delimiter = '|', $request->options)),
            'validation' => $this->constructValidationRules($request)
        ]));

        $input->save();

        return redirect()->back();
    }


    /**
     * Returns the Laravel formatted validation string
     *
     * @param Request $request
     * @return string
     */
    private function constructValidationRules(Request $request)
    {
        $rules = [];

        $requireValue = [
            'same'
        ];

        foreach ($request->all() as $input => $value) {
            if (str_contains($input, 'validation_')) {
                $trimmed_input = str_replace('validation_', '', $input);

                if (in_array($trimmed_input, $requireValue)) {
                    $rules[] = "{$trimmed_input}:{$value}";
                    continue;
                }

                $rules[] = $trimmed_input;
            }
        }

        return implode($glue = '|', $rules);
    }


    /**
     * Delete an Input
     *
     * @param Models\Form $form
     * @param Models\Input $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteInput(Models\Form $form, Models\Input $input)
    {
        $input->delete();

        return redirect()->back();
    }


    /**
     * Move an input up or down
     */
    public function updateInputPosition()
    {
        //
    }

}