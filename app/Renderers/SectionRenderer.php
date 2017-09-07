<?php

namespace App\Renderers;

use App\Block;
use App\Section;

/**
 * Class SectionRenderer
 * @package App\Helpers
 */
class SectionRenderer
{

    /**
     * Open the section
     *
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render(Section $section)
    {
        $blocks = "";

        $section->blocks->each(function (Block $block) use (&$blocks) {
            $blocks .= BlockRenderer::render($block);
        });

        return view('section', [
            'blocks' => $blocks
        ]);
    }

}