<?php

namespace App\Services\Parsers;

use App\Services\Parsers\Loaders\ILoader;
use DOMDocument;
use DOMNodeList;
use DOMXPath;

abstract class BaseRealEstateParser implements IRealEstateParser
{
    private ILoader $loader;

    public function __construct(ILoader $loader)
    {
        $this->loader = $loader;
    }

    protected function parse($url, $query): DOMNodeList
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($this->loader->load($url));

        $domxpath = new DOMXPath($dom);
        $nodeList = $domxpath->query($query);
        if (! $nodeList->count()) throw new ParsingException('Not Found');

        return $nodeList;
    }
}