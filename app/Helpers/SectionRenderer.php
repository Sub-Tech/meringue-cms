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
        $blockRenderer = new BlockRenderer();

        $blocks = '';

        $section->blocks->each(function (Block $block) use ($blockRenderer, &$blocks) {
            $this->initialisePlugin($block->plugin_class);
            $blocks .= $blockRenderer->render($block);
        });

        return view('section', [
            'blocks' => $blocks
        ]);
    }


    /**
     * Initialises the plugin ready for rendering
     *
     * @param $plugin
     * @return mixed
     */
    private function initialisePlugin($plugin)
    {
        return new $plugin();
    }

}