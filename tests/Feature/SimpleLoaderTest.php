<?php

namespace Tests\Feature;

use App\Services\Parsers\Loaders\SimpleLoader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SimpleLoaderTest extends TestCase
{
    public function test_load_property(): void
    {
        Http::fake([
            'https://www.zillow.com/homedetails/1110-William-St-Hewlett-NY-11557/31258929_zpid/' => 
                Http::response(file_get_contents(__DIR__ . '/fixtures/property.html')),
        ]);
        $loader = new SimpleLoader;
        $html = $loader->load('https://www.zillow.com/homedetails/1110-William-St-Hewlett-NY-11557/31258929_zpid/');

        $this->assertIsString($html);
    }
}
