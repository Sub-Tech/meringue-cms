<?php

namespace App\Renderers;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class HeaderRenderer
{

    /**
     * Render the header
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view(env('THEME') . '/header', [
            'tits' => "Stretch"
        ]);
    }

}