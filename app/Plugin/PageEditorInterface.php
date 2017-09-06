<?php

namespace App\Plugin;

/**
 * Interface PageEditorInterface
 * @package App\Plugin
 */
interface PageEditorInterface
{

    /**
     * Return a path to the block preview file
     * Starts in the plugins/ folder
     *
     * @return string
     */
    public function renderBlockPreview(): string;

}