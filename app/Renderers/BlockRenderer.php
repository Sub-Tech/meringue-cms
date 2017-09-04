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
            throw new RenderInactivePluginException;
        }

        $plugin = $this->pluginInitialiser->getPlugin($block->plugin_class);

        if ($plugin->implements(InstanceInterface::class) && is_null($block->instance_id)) {
            return "<span style='color:red'>Content not set for block {$block->id}!</span>";
        }

        return "<div class='block col-md-{$block->width}'>" .
            $plugin->render($block->instance_id) .
            "</div>";
    }


    /**
     * Checks the plugins array for inactive plugins
     *
     * @param Block $block
     * @return bool
     */
    private function isTryingToRenderAnInactivePlugin(Block $block)
    {
        $currentPlugin = get_plugin_short_name($block->plugin_class);

        return !$this->pluginInitialiser->plugins->has($currentPlugin);
    }

}