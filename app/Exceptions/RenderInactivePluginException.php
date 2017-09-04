<?php

namespace App\Exceptions;
use Throwable;

/**
 * Class RenderInactivePluginException
 * @package App\Exceptions
 */
class RenderInactivePluginException extends \Exception
{

    /**
     * RenderInactivePluginException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        dd('here');
        return abort(500);
    }

}