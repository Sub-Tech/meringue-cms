<?php

namespace App\Plugin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Interface PluginInterface
 * To be implemented when a Plugin can have unique instances
 * Forms, Text Blocks for Example. Not STAMP coz that's static
 *
 * @package App
 */
interface InstanceInterface
{

    /**
     * Get the specified Instance of the Plugin
     *
     * @param int $instanceId
     * @return Collection|\stdClass|Model
     */
    public function getInstance(int $instanceId);


    /**
     * Save an instance of the plugin to the db
     * Return the inserted ID
     *
     * @param Request $request
     * @return int $instanceId
     */
    public function saveInstance(Request $request): int;


    /**
     * Update the Instance in the DB and return success via bool
     *
     * @param int $instanceId
     * @param Request $request
     * @return bool
     */
    public function updateInstance(int $instanceId, Request $request): bool;

}