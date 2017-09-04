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
     * @throws RenderInactivePluginException
     */
    public function render(Block $block)
    {
        if ($this->isTryingToRenderAnInactivePlugin($block)) {
            throw new RenderInactivePluginException("Inactive Plugin trying to be rendered", 500);
        }

        $plugin = $this->pluginInitialiser->getPlugin($block->plugin_class);

        if ($plugin->implements(InstanceInterface::class) && is_null($block->instance_id)) {
            return "<span style='color:red'>Content not set for block {$block->id}!</span>";
        }

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }

}