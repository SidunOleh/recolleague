<?php

namespace App\Services\Parsers\Loaders;

use Illuminate\Support\Facades\Http;

class ScrapperAPILoader implements ILoader
{
    public function load(string $url): string
    {
        $url = 'https://api.scraperapi.com?' . http_build_query([
            'api_key' => env('SCRAPPERAPI_KEY'),
            'url' => $url,
            'render' => 'true',
        ]);
        $response = Http::retry(2)->get($url);
        
        if ($response->getStatusCode() != 200) {
            throw new LoadingException(
                $response->getReasonPhrase()
            );
        }

        $content = $response->getBody()->getContents();
        
        return $content;
    }
}