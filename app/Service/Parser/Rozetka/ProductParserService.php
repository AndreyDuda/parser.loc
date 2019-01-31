<?php

namespace App\Service\Parser\Rozetka;

use App\Service\IParser;
use Symfony\Component\DomCrawler\Crawler;

class ProductParserService implements IParser
{
    const NAME = 'ProductParserService';

    private $links;

    public function __construct($link)
    {
        $this->links = $link;
    }

    public function parse()
    {
        $content = [];

        foreach ($this->links['content'] as $link) {
            $html    = file_get_contents($link);
            $crawler = new Crawler(null, $link);
            $crawler->addHtmlContent($html, 'UTF-8');
            $content['title'] = $crawler->filter('.detail-title')->text();
            $content['text']  = $crawler->filter('.short-description')->text();
            $content['price'] = $crawler->filter('#price_label')->text();
            $content['image'] = $crawler->filter('.detail-img-thumbs-l-i')->each(function (Crawler $node, $i) {
                return $node->children('a')->attr('href');
            });
            dd($this->links['content']);
        }

        dd($content);


        return self::NAME;
    }

}
