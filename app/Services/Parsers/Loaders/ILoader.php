<?php

namespace App\Services\Parsers\Loaders;

interface ILoader
{
    public function load(string $url): string;
}