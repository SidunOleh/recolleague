<?php

namespace Tests\Feature;

use App\Services\Parsers\Loaders\ScrapperAPILoader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ScrapperAPILoaderTest extends TestCase
{
    public function test_load_property(): void
    {
        $url = 'https://www.zillow.com/homedetails/1110-William-St-Hewlett-NY-11557/31258929_zpid';
        $scraperAPIUrl = 'http://api.scraperapi.com?' . http_build_query([
            'api_key' => env('SCRAPPERAPI_KEY'),
            'url' => $url,
            'render' => 'true',
        ]);
        Http::fake([$scraperAPIUrl => Http::response(file_get_contents(__DIR__ . '/fixtures/property.html')),]);
        $loader = new ScrapperAPILoader;
        $html = $loader->load($url);

        $this->assertIsString($html);
    }
}
