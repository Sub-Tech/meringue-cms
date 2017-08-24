<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BlockController
 * @package App\Http\Controllers\Admin
 */
class BlockController extends Controller
{

    /**
     * Create a new Block
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Block::create($request->all());

        return redirect()->back();
    }


    /**
     * Update a Block and return if it worked or not
     *
     * @param Request $request
     * @param Block $block
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Block $block)
    {
        $block->update($request->all());

        return redirect()->back();
    }


    /**
     * Delete a Block
     *
     * @param Block $block
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Block $block)
    {
        $success = $block->delete();

        return response()->json([
            'success' => $success
        ], $success ? 200 : 500);
    }

}
