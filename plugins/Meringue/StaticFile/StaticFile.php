<?php

namespace Plugins\Meringue\StaticFile;

use App\Plugin\InstanceInterface;
use App\Plugin\PageEditorInterface;
use App\Plugin\PluginBase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class StaticFile
 *
 * @package Plugins\Meringue\Text
 */
class StaticFile extends PluginBase implements InstanceInterface, PageEditorInterface
{

    /**
     * The table name
     *
     * @var string
     */
    private $table = "meringue_static_file";

    /**
     * StaticFile constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (\Schema::hasTable($this->table)) {
            $savedFiles = DB::table($this->table)->get()->keyBy('filename');
            $currentFiles = collect(trim_directory_path(scandir(__DIR__ . "/files")));

            $currentFiles->each(function (string $file) use ($savedFiles) {
                if (!$savedFiles->has($file)) {
                    DB::table($this->table)->insert(["filename" => $file]);
                }
            });
        }
    }

    /**
     * Set the Vendor of the Plugin
     *
     * @return void
     */
    public function setVendor() : void
    {
        $this->vendor = 'Meringue';
    }


    /**
     * Set the name of the Plugin
     *
     * @return void
     */
    public function setName() : void
    {
        $this->name = 'StaticFile';
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
        $file = DB::table($this->table)
            ->find($instanceId)
            ->filename;

        if (!file_exists(__DIR__ . "/files/{$file}")) {
            return false;
        }

        try {
            include_once $file;
        } catch (\Throwable $throwable) {
            //
        }

        return true;
    }


    /**
     * Details used for the plugin
     * @return array
     */
    public function details() : array
    {
        return [
            'name' => 'Static File',
            'description' => 'Allows you to include static PHP files',
            'author' => 'James Lewis',
            'icon' => './assets/images/block-icon.png',
        ];
    }


    /**
     * Construct the Modal that appears in the Page Editor
     *
     * @return array
     */
    public function constructEditorModal() : array
    {
        $instances = DB::table($this->table)->get();

        $instances->each(function ($instance) {
            $instance->name = $instance->filename;
        });

        return [
            "instances" => $instances
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
        $instance = DB::table($this->table)
            ->find($instanceId);

        $instance->name = $instance->filename;

        return $instance;
    }


    /**
     * Save an instance of the plugin to the db
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request) : int
    {
        return DB::table($this->table)
            ->insertGetId($request->only(['name', 'filename']));
    }


    /**
     * Update the Instance in the DB and return success via bool
     *
     * @param int $instanceId
     * @param Request $request
     * @return bool
     */
    public function updateInstance(int $instanceId, Request $request) : bool
    {
        return DB::table($this->table)
            ->where('id', $instanceId)
            ->update($request->only(['name', 'filename']));
    }


    /**
     * Delete the Instance from the DB
     * Return success state
     *
     * @param int $instanceId
     * @return bool
     */
    public function deleteInstance(int $instanceId) : bool
    {
        return DB::table($this->table)
            ->delete($instanceId);
    }

    /**
     * Return a link to the block preview file
     *
     * @return string
     */
    public function renderBlockPreview() : string
    {
        return 'Meringue/StaticFile/views/admin/page/block';
    }

    /**
     * Display the block type icon
     *
     * @return string
     */
    public function setFontAwesomeIcon() : string
    {
        return '<i class="fa fa-font" aria-hidden="true"></i>';
    }

}
