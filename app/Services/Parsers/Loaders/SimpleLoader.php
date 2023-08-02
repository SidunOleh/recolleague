<?php

namespace App\Services\Parsers\Loaders;

use Illuminate\Support\Facades\Http;

class SimpleLoader implements ILoader
{
    public function load(string $url): string
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Safari/537.36',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Referer' => 'https://www.google.com/',
        ])->get($url);

        if ($response->getStatusCode() != 200) {
            throw new LoadingException(
                $response->getReasonPhrase()
            );
        }

        $content = $response->getBody()->getContents();
        
        return $content;
    }
}