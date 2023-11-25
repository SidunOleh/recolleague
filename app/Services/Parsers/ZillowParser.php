<?php

namespace App\Services\Parsers;

class ZillowParser extends BaseRealEstateParser
{
    public function propertyDetails(string $url): array
    {
        $this->load($url);

        $details['ba'] = $this->getBathroomsCount();
        $details['bd'] = $this->getBedroomsCount();
        $details['schools'] = $this->getSchools();
        $details['type'] = $this->homeType();
        $details['family_room'] = $this->hasFamilyRoom();
        $details['living_room'] = $this->hasLivingRoom();
        $details['kitchen'] = $this->hasKitchen();
        $details['fireplace'] = $this->hasFireplace();

        return $details;
    }

    private function getBathroomsCount(): int|null
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);
        preg_match('/\\\"bathrooms\\\":(.*?),/', $node->textContent ?? '', $matches);
        $bathrooms = $matches[1] ?? 0;

        return $bathrooms;
    }

    private function getBedroomsCount(): int|null
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);
        preg_match('/\\\"bedrooms\\\":(.*?),/', $node->textContent ?? '', $matches);
        $bedrooms = $matches[1] ?? 0;

        return $bedrooms;
    }

    private function getSchools(): array
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);
        preg_match('/\\\"schools\\\":(\[.*?\])/', $node->textContent ?? '', $json);
        $schools = json_decode(stripslashes($json[1] ?? ''), true);

        return $schools ?: [];
    }

    private function homeType(): string|null
    {
        $node = $this->parse('.//span[@class="Text-c11n-8-84-3__sc-aiai24-0 hdp__sc-6k0go5-3 hrfydd llcOCk"][1]')->item(0);
        
        return $node->textContent ?? null;
    }

    private function hasFamilyRoom(): bool
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);

        return preg_match('/\\\"roomType\\\":\\\"FamilyRoom\\\"/', $node->textContent ?? '');
    }

    private function hasLivingRoom(): bool
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);

        return preg_match('/\\\"roomType\\\":\\\"LivingRoom\\\"/', $node->textContent ?? '');
    }

    private function hasKitchen(): bool
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);

        return preg_match('/\\\"roomType\\\":\\\"Kitchen\\\"/', $node->textContent ?? '');
    }

    private function hasFireplace(): bool
    {
        $node = $this->parse('.//script[@id="__NEXT_DATA__"]')->item(0);
        preg_match('/\\\"hasFireplace\\\":(.*?),/', $node->textContent ?? '', $hasFireplace);

        return ($hasFireplace[1] ?? '') == 'true' ? true : false;
    }
}