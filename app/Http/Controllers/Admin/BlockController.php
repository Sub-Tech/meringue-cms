<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Page;
use App\Plugin;
use App\PluginBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class BlockController extends Controller
{

    /**
     * @param Block $block
     */
    public function update(Block $block) {
        $block->update(Input::get());
        return response()->json(['success' => true]);
    }



}
