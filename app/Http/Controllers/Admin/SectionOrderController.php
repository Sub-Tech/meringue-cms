<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use App\Http\Responses\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSectionOrder;

/**
 * Class SectionOrderController
 * @package App\Http\Controllers\Admin
 */
class SectionOrderController extends Controller
{

    /**
     * Update the order of the Sections
     *
     * @param UpdateSectionOrder $request
     * @return AjaxResponse
     */
    public function update(UpdateSectionOrder $request)
    {
        $position = 0;

        // $request->item is an array of Block->ids in desired order
        foreach ($request->section as $itemId) {
            Section::whereId($itemId)->update([
                'position' => $position
            ]);

            $position++;
        }

        return new AjaxResponse('Order Updated', true);
    }

}
