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
     * @var HeaderRenderer
     */
    protected $headerRenderer;

    /**
     * @var SectionRenderer
     */
    protected $sectionRenderer;

    /**
     * @var FooterRenderer
     */
    protected $footerRenderer;


    /**
     * PageRenderer constructor.
     *
     * @param HeaderRenderer $headerRenderer
     * @param SectionRenderer $sectionRenderer
     * @param FooterRenderer $footerRenderer
     */
    public function __construct(HeaderRenderer $headerRenderer, SectionRenderer $sectionRenderer, FooterRenderer $footerRenderer)
    {
        $this->headerRenderer = $headerRenderer;
        $this->sectionRenderer = $sectionRenderer;
        $this->footerRenderer = $footerRenderer;
    }


    /**
     * Render the page for the front end
     *
     * @param Page $page
     * @return mixed
     */
    public function page(Page $page)
    {
        $view = $this->headerRenderer->render();

        $page->sections->each(function (Section $section) use (&$view) {
            $view .= $this->sectionRenderer->render($section);
        });

        $view .= $this->footerRenderer->render();

        return $view;
    }

}