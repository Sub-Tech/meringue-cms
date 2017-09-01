<?php

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return response()->json([
            'message' => $this->message,
            'success' => $this->success
        ]);
    }

}