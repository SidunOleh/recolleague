<?php

namespace App\Services\Parsers;

use App\Services\Parsers\Loaders\ScrapperAPILoader;
use App\Services\Parsers\Loaders\SimpleLoader;

class RealEstateParserFactory
{
    public static function build(): IRealEstateParser
    {
        $loader = new SimpleLoader;
        $parser = new ZillowParser($loader);

        return $parser;
    }
}