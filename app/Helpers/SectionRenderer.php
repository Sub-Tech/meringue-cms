<?php

namespace App\Helpers;

use App\Block;
use App\Section;
use Illuminate\Support\Collection;

/**
 * Class SectionRenderer
 * @package App\Helpers
 */
class SectionRenderer
{

    /**
     * Open the section
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(Section $section)
    {
        $blocks = $this->blocks($section->blocks);

        return view('section', [
            'blocks' => $blocks
        ]);
    }


    /**
     * Close the section
     * @param Collection $blocks
     * @return string
     */
    private function blocks(Collection $blocks)
    {
        $html = '';

        $blocks->each(function (Block $block) use (&$html) {
            $html .= "<div class='block'>{$block->id}</div>";
        });

        return $html;
    }

}