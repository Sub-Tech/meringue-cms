<?php

namespace Plugins\Meringue\Form;

use App\Http\Responses\AjaxResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
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
     * @return AjaxResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request) : JsonResponse
    {
        try {
            /** @var \Plugins\Meringue\Form\Models\Form $form */
            $form = Models\Form::findOrFail($request->form_id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        Validator::validate($request->all(), $this->validationArray($form));

        return new AjaxResponse(
            $message = 'Form submitted',
            $success = (bool) Models\Response::create(array_merge(
                $request->all(), [
                'answers' => json_encode($request->except(['vendor', 'plugin', 'form_id']))
            ]))
        );
    }

}