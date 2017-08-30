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

//    use ConstructsValidation; Uncomment once fixed autoloading

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

        return redirect()->route('Form.edit', [
            'form' => $form->fresh()->id
        ]);
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
            'validation' => $this->constructRulesFrom($request)
        ]));

        $input->save();

        return redirect()->back();
    }


    /**
     * Delete an Input
     * The $form parameter is necessary but I don't remember why
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


    /**
     * Returns the Laravel formatted validation string
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function constructRulesFrom(Request $request): ?string
    {
        $rules = [];

        foreach ($request->all() as $input => $value) {
            if ($this->inputIsNotRelevant($input)) {
                continue;
            }

            $this->parse($input);

            if ($this->validationRuleRequiresValue($input)) {
                $rules[] = "{$input}:{$value}";
                continue;
            }

            $rules[] = $input;
        }

        return implode($glue = '|', $rules);
    }


    /**
     * Checks to see if the input validation rule requires a value
     *
     * @param string $input
     * @return bool
     */
    private function validationRuleRequiresValue(string $input)
    {
        return in_array($input, $requireValue = [
            'same'
        ]);
    }


    /**
     * Ignore any passed inputs not relevant to constructing validation
     *
     * @param string $input
     * @return bool
     */
    private function inputIsNotRelevant(string $input)
    {
        return str_contains($input, 'validation_');
    }


    /**
     * Remove validation_ from the input name
     *
     * @param string $input
     */
    private function parse(string &$input)
    {
        str_replace('validation_', '', $input);
    }

}