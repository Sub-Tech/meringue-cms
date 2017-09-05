<?php

namespace App\Renderers;

use App\Block;
use App\Plugin\InstanceInterface;
use App\Plugin\PluginInitialiser;
use App\Exceptions\RenderInactivePluginException;

/**
 * Class BlockRenderer
 * @package App\Helpers
 */
class BlockRenderer
{
    use RendersPlugins;

    /**
     * @var PluginInitialiser
     */
    private $pluginInitialiser;


    /**
     * BlockRenderer constructor.
     * @param PluginInitialiser $pluginInitialiser
     */
    public function __construct(PluginInitialiser $pluginInitialiser)
    {
        $this->pluginInitialiser = $pluginInitialiser;
    }


    /**
     * Open the section
     *
     * @param Block $block
     * @return string (of HTML)
     */
    public function render(Block $block)
    {
        if ($this->isTryingToRenderAnInactivePlugin($block)) {
            return "";
        }

        $plugin = $this->pluginInitialiser->getPlugin($block->plugin_class);

        if ($plugin->implements(InstanceInterface::class) && is_null($block->instance_id)) {
            return "";
        }

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }

}