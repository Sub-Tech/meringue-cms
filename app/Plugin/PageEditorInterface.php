<?php

namespace App\Plugin;

/**
 * Interface PluginInterface
 * To be implemented when a Plugin can have unique instances
 * Forms, Text Blocks for Example. Not STAMP coz that's static
 *
 * @package App
 */
interface PageEditorInterface
{

    /**
     * Return a link to the block preview file
     *
     * @return string
     */
    public function renderBlockPreview(): string;

}