<?php

namespace App\Services\Parsers;

class ZillowParser extends BaseRealEstateParser
{
    public function propertyDetails(string $url): array
    {
        $this->load($url);

        $details['ba'] = $this->getBathroomsCount();
        $details['bd'] = $this->getBedroomsCount();

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
}