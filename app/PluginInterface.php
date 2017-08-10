<?php

namespace App;

interface PluginInterface
{
    public function setDetails(): array;

    public function setVendor();

    public function setName();

    public function setViewsPath();
}