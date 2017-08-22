<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\BlockRegistry;
use App\Helpers\PluginInitialiser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BlockController
 * @package App\Http\Controllers\Admin
 */
class BlockController extends Controller
{

    /**
     * Create a new Block
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Block::create($request->all());

        return redirect()->back();
    }


    /**
     * Update a Block and return if it worked or not
     *
     * @param Request $request
     * @param Block $block
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Block $block)
    {
        $block->update($request->all());

        return redirect()->back();
    }


    /**
     * Delete a Block
     *
     * @param Block $block
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Block $block)
    {
        $success = $block->delete();

        return response()->json([
            'success' => $success
        ], $success ? 200 : 500);
    }


    /**
     * Registers the plugins block in the database
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshRegistry()
    {
        $newBlocks = 0;

        $this->pluginInitialiser->plugins->each(function ($plugin) use (&$newBlocks) {
            $newBlocks += $this->registerNewBlock($plugin, $newBlocks);
        });

        return response()->json([
            'success' => true,
            'message' => 'Number of new blocks found : ' . $newBlocks
        ]);
    }


    /**
     * Register a new Block
     *
     * @param $plugin
     * @param $newBlocks
     * @return mixed
     */
    private function registerNewBlock($plugin, $newBlocks)
    {
        $pluginClass = PluginInitialiser::getPlugin($plugin->class);

        if (!method_exists($pluginClass, 'registerBlock')) {
            return $newBlocks;
        }

        $blockRegistry = BlockRegistry::findOrNew($plugin->class);

        if (!$blockRegistry->exists) {
            $blockRegistry->plugin_class = $plugin->class;
            $newBlocks++;
        }

        $blockRegistry->fill($pluginClass->registerBlock())->save();

        return $newBlocks;
    }

}
