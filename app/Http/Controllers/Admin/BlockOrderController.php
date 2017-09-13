<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBlockOrder;
use App\Http\Responses\AjaxResponse;
use App\Section;

/**
 * Class BlockOrderController
 * @package App\Http\Controllers\Admin
 */
class BlockOrderController extends Controller
{

    /**
     * Update the order of the Blocks
     *
     * @param UpdateBlockOrder $request
     * @return AjaxResponse
     */
    public function update(UpdateBlockOrder $request)
    {
        $position = 1;

        /** @var int[$block->id] $request->item */
        foreach ($request->block as $itemId) {
            Block::whereId($itemId)->update([
                'position' => $position
            ]);

            $position++;
        }

        return new AjaxResponse('Order Updated', true);
    }

}
