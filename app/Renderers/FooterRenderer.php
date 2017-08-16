<?php

namespace App\Renderers;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class FooterRenderer
{

    /**
     * Render the footer
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(env('THEME') . '/footer', [
            'tits' => "wonderful<br/>"
        ]);
    }

}