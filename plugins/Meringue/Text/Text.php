<?php

namespace Plugins\Meringue\Text;

use App\Plugin\InstanceInterface;
use App\Plugin\PageEditorInterface;
use App\Plugin\PluginBase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class Text
 * @package Plugins\Meringue\Text
 */
class Text extends PluginBase implements InstanceInterface, PageEditorInterface
{

    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor(): void
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName(): void
    {
        $this->name = 'Text';
    }


    /**
     * Runs any method that need to be ran upon installation of the Plugin
     * Return false if not necessary
     *
     * @return void|bool
     */
    public function install()
    {
        $this->runMigrations();
    }


    /**
     * Route begins from the plugins/ folder
     * Must return view('merchant/plugin/views/viewName) or equivalent
     * Return false if plugin doesn't need to render anything on the front end
     *
     * @param int|null $instanceId
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render(int $instanceId = null)
    {
        $content = DB::table('meringue_text_text')->find($instanceId)->content;

        return view('Meringue/Text/views/text')
            ->with('content', $content);
    }


    /**
     * Details used for the plugin
     * @return array
     */
    public function details(): array
    {
        return [
            'name' => 'Text',
            'description' => 'Allows you to easily create a text block',
            'author' => 'James Lewis',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal(): array
    {
        return [
            'inputs' => [ // Inputs for the page editor
                'name' => [
                    'type' => 'text'
                ],
                'content' => [ // Key must be same as database column
                    'type' => 'textarea' // This will load a corresponding input in the page editor
                ],
            ]
        ];
    }


    /**
     * Get the Text Instance
     *
     * @param int $instanceId
     * @return Collection
     */
    public function getInstance(int $instanceId)
    {
        return DB::table('meringue_text_text')->find($instanceId);
    }


    /**
     * Save an instance of the plugin to the db
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int
    {
        return DB::table('meringue_text_text')
            ->insertGetId($request->only(['name', 'content']));
    }


    /**
     * Update the Instance in the DB and return success via bool
     *
     * @param int $instanceId
     * @param Request $request
     * @return bool
     */
    public function updateInstance(int $instanceId, Request $request): bool
    {
        return DB::table('meringue_text_text')
            ->where('id', $instanceId)
            ->update($request->only(['name', 'content']));
    }


    /**
     * Delete the Instance from the DB
     * Return success state
     *
     * @param int $instanceId
     * @return bool
     */
    public function deleteInstance(int $instanceId): bool
    {
        return DB::table('meringue_text_text')->delete($instanceId);
    }

    /**
     * Return a link to the block preview file
     *
     * @return string
     */
    public function renderBlockPreview(): string
    {
        return 'Meringue/Text/views/admin/page/block';
    }

    /**
     * Display the block type icon
     *
     * @return string
     */
    public function setFontAwesomeIcon(): string
    {
        return '<i class="fa fa-font" aria-hidden="true"></i>';
    }

}
