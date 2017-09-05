<?php

namespace App\Renderers;

use App\Block;
use App\Exceptions\RenderInactivePluginException;
use App\Section;
use Illuminate\Support\Facades\View;

/**
 * Class SectionRenderer
 * @package App\Helpers
 */
class SectionRenderer
{

    /**
     * @var BlockRenderer
     */
    private $blockRenderer;


    /**
     * SectionRenderer constructor.
     * @param BlockRenderer $blockRenderer
     */
    public function __construct(BlockRenderer $blockRenderer)
    {
        $this->blockRenderer = $blockRenderer;
    }


    /**
     * Open the section
     *
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(Section $section)
    {
        $blocks = "<div class='container'><div class='row'>";

        try {
            $section->blocks->each(function (Block $block) use (&$blocks) {
                $blocks .= $this->blockRenderer->render($block);
            });
        } catch (RenderInactivePluginException $exception) {
            return abort(500, "Inactive Plugin on Page");
        }

        $blocks .= "</div></div>";

        return view('section', [
            'blocks' => $blocks
        ]);
    }

}