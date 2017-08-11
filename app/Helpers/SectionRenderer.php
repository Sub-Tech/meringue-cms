<?php

namespace App\Helpers;

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
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(Section $section)
    {
        $br = new BlockRenderer();

        $blocks = '';

        $section->blocks->each(function (Block $block) use ($br, &$blocks) {
            $this->initialisePlugin($block->plugin_class);
            $blocks .= $br->render($block);
        });

        return view('section', [
            'blocks' => $blocks
        ]);
    }


    private function initialisePlugin($plugin)
    {
        return new $plugin();
    }

}