<?php

namespace App\Services\Parsers;

interface IRealEstateParser
{
    public function propertyDetails(string $url): array;
} 