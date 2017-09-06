<?php

namespace App\Plugin;

/**
 * Trait OverridesBlockEditor
 * @package App\Plugin
 */
trait OverridesBlockEditor
{

    /**
     * Sees if you should overwrite the block editor in the page editor
     * I'm too tired for this shit
     *
     */
    public function overrideBlockEdit(): string
    {
        return "{$this->vendor}/{$this->name}/views/admin/page/block";
    }

}