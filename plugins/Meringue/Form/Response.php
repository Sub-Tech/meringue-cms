<?php

namespace Plugins\Meringue\Form;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

/**
 * Class Response
 * @package Plugins\Meringue\Form
 */
class Response
{

    use ValidatesInputs;

    /**
     * Show all Responses for this form
     *
     * @param Models\Form $form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Models\Form $form)
    {
        return view('Meringue/Form/views/responses')
            ->with('form', $form);
    }


    /**
     * View particular response
     *
     * @param Models\Form $form
     * @param Models\Response $response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Models\Form $form, Models\Response $response)
    {
        return view('Meringue/Form/views/response')
            ->with('response', $response);
    }


    /**
     * Store the Response
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            /** @var \Plugins\Meringue\Form\Models\Form $form */
            $form = Models\Form::findOrFail($request->form_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Request Failed'
            ], 500);
        }

        Validator::validate($request->all(), $this->validationArray($form));

        $success = (new Models\Response())->fill(array_merge(
            $request->all(), [
            'answers' => json_encode($request->except(['vendor', 'plugin', 'form_id']))
        ]))->save();

        return response()->json([
            'success' => $success
        ], $success ? 200 : 500);
    }

}