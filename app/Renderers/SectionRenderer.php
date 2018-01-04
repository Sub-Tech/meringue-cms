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
        $blocks = [];
        $render_type = 'section';

        $i = 1;
        $section->blocks->each(function (Block $block) use (&$blocks, &$i) {
            $blocks[$i]['html'] = $block->render(($block->plugin_class == 'Plugins\Meringue\StaticFile\StaticFile')?false: true);
            $blocks[$i]['class_name'] = $block->plugin_class;
            $i ++;
        });

        if(sizeof($blocks) == 1 &&  $blocks[1]['class_name'] == 'Plugins\Meringue\StaticFile\StaticFile'){
            $render_type = 'full_width';
        }

        return view('section', [
            'render_type' => $render_type,
            'section' => $section,
            'blocks' => $blocks
        ]);
    }

}