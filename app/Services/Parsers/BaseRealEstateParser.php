<?php

namespace App\Services\Parsers;

use App\Services\Parsers\Loaders\ILoader;
use DOMDocument;
use DOMNodeList;
use DOMXPath;

abstract class BaseRealEstateParser implements IRealEstateParser
{
    protected ILoader $loader;

    protected string $html;

    public function __construct(ILoader $loader)
    {
        $this->loader = $loader;
        $this->html = '';
    }

    protected function load($url): string
    {
        $html = $this->loader->load($url);
        $this->html = $html;

        return $this->html;
    }

    protected function parse($query): DOMNodeList
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($this->html);

        $domxpath = new DOMXPath($dom);
        $nodeList = $domxpath->query($query);
        if ($nodeList === false) throw new ParsingException('Parsing error');

        return $nodeList;
    }
}