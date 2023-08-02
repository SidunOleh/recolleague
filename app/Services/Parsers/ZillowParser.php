<?php

namespace App\Services\Parsers;

class ZillowParser extends BaseRealEstateParser
{
    public function propertyDetails(string $url): array
    {
        $this->load($url);

        $details['ba'] = $this->getBathroomsCount();
        $details['bd'] = $this->getBedroomsCount();
        $details['schools'] = $this->getSchools() ?? [];

        return $details;
    }

    private function getBathroomsCount(): int|null
    {
        $nodeList = $this->parse('.//span[@data-testid="bed-bath-item"]');
        foreach ($nodeList as $node) {
            if ( 
                trim($node->childNodes->item(1)->textContent) == 'ba' 
            ) {
                return (int) $node->childNodes->item(0)->textContent;
            }
        }
    }

    private function getBedroomsCount(): int|null
    {
        $nodeList = $this->parse('.//span[@data-testid="bed-bath-item"]');
        foreach ($nodeList as $node) {
            if ( 
                trim($node->childNodes->item(1)->textContent) == 'bd' 
            ) {
                return (int) $node->childNodes->item(0)->textContent;
            }
        }
    }

    private function getSchools(): array|null
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);
        preg_match('/\\\"schools\\\":(\[.*?\])/', $node->textContent, $json);
        $schools = json_decode(stripslashes($json[1]), true);

        return $schools;
    }
}