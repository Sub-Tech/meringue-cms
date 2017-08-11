<?php

namespace App\Helpers;

use App\Page;
use App\Section;

/**
 * Class PageRenderer
 * @package App\Helpers
 */
class PageRenderer
{

    /**
     * @var SectionRenderer
     */
    protected $sectionRenderer;


    /**
     * PageRenderer constructor.
     * @param SectionRenderer $sectionRenderer
     */
    public function __construct(SectionRenderer $sectionRenderer)
    {
        $this->sectionRenderer = $sectionRenderer;
    }


    /**
     * Render the page for the front end
     * @param Page $page
     * @return mixed
     */
    public function page(Page $page)
    {
        $view = $this->renderHeader();

        $page->sections->each(function (Section $section) use (&$view) {
           $view .= $this->sectionRenderer->render($section);
        });

        $view .= $this->renderFooter();

        return $view;
    }


    /**
     * Render the header for the front end from
     */
    private function renderHeader()
    {
        return view(env('THEME') . '/header', [
            'tits' => "Stretch"
        ]);
    }


    /**
     * Render the header for the front end from
     */
    private function renderFooter()
    {
        return view(env('THEME') . '/footer', [
            'tits' => "wonderful<br/>"
        ]);
    }

}