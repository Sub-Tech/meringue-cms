<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Section;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlock;
use App\Http\Requests\UpdateBlock;
use App\Http\Responses\AjaxResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

/**
 * Class BlockController
 * @package App\Http\Controllers\Admin
 */
class BlockController extends Controller
{

    /**
     * Create a new Block
     *
     * @param CreateBlock $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function store(CreateBlock $request, Section $section)
    {
        Block::create(array_merge(
            $request->all(), [
            'order' => $section->getHighestPosition() + 1
        ]));

        return Redirect::back();
    }


    /**
     * Update a Block and return if it worked or not
     *
     * @param UpdateBlock $request
     * @param Block $block
     * @return RedirectResponse
     */
    public function update(UpdateBlock $request, Block $block)
    {
        $block->update($request->all());

        return Redirect::back();
    }


    /**
     * Delete a Block
     *
     * @param Block $block
     * @return AjaxResponse
     */
    public function delete(Block $block)
    {
        $success = $block->delete();
        $message = $success ? 'Block deleted' : 'Error';

        return new AjaxResponse($message, $success);
    }

}
