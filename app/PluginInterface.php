<?php

namespace App;

interface PluginInterface
{
    public function setDetails(): array;

    public function setVendor(string $vendor);

    public function setName(string $name);
}