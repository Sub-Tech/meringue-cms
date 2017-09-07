<?php

namespace App\Renderers;

use App\Page;
use App\Section;

/**
 * Class PageRenderer
 * @package App\Helpers
 */
class PageRenderer
{

    /**
     * Render the page for the front end
     *
     * @param Page $page
     * @return mixed
     */
    public static function render(Page $page)
    {
        $view = HeaderRenderer::render();

        $page->sections->each(function (Section $section) use (&$view) {
            $view .= $section->render();
        });

        $view .= FooterRenderer::render();

        return $view;
    }

}