<?php

namespace Tests\Unit;

use App\Services\Parsers\Loaders\ILoader;
use App\Services\Parsers\ZillowParser;
use PHPUnit\Framework\TestCase;

class ZillowParserTest extends TestCase
{
    public function test_get_property_details(): void
    {
        $mockLoader = $this->createMock(ILoader::class);
        $mockLoader->method('load')->willReturn(file_get_contents(__DIR__ . '/fixtures/property.html'));
        $parser = new ZillowParser($mockLoader);
        $details = $parser->propertyDetails('https://www.zillow.com/homedetails/1110-William-St-Hewlett-NY-11557/31258929_zpid/');

        $this->assertArrayHasKey('ba',$details);
        $this->assertArrayHasKey('bd',$details);
        $this->assertArrayHasKey('schools',$details);
        $this->assertArrayHasKey('type',$details);
        $this->assertArrayHasKey('family_room',$details);
        $this->assertArrayHasKey('living_room',$details);
        $this->assertArrayHasKey('kitchen',$details);
        $this->assertArrayHasKey('fireplace',$details);
    }
}
