<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class AjaxResponse
 */
class AjaxResponse implements Responsable
{

    /**
     * @var string
     */
    private $message = '';

    /**
     * @var bool|string
     */
    private $success = '';


    /**
     * AjaxResponse constructor.
     *
     * @param string $message
     * @param bool $success
     */
    public function __construct(string $message, bool $success)
    {
        $this->message = $message;
        $this->success = $success;
    }


    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return Response::json([
            'message' => $this->message,
            'success' => $this->success
        ]);
    }

}