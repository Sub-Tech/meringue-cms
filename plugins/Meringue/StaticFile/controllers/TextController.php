<?php

namespace Plugins\Meringue\Text;


use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: jameslewis
 * Date: 14/08/2017
 * Time: 16:40
 */
class TextController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        die('IN THE CONSTRUCT');
    }


    public function index()
    {
        die('HELLO JADEN');
    }

}