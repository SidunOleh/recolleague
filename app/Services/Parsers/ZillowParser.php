<?php

namespace App\Services\Parsers;

class ZillowParser extends BaseRealEstateParser
{
    public function propertyDetails(string $url): array
    {
        $nodeList = $this->parse($url, './/span[@data-testid="bed-bath-item"]');
        $details = [];
        foreach ($nodeList as $node) {
            $name = trim($node->childNodes->item(1)->textContent);
            $value = $node->childNodes->item(0)->textContent;
            $details[$name] = $value;
        }

        return $details;
    }
}