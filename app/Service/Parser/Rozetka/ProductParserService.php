<?php

namespace App\Service\Parser\Rozetka;

use App\Service\Error\ErrorCrawler\ErrorNodeEmpty;
use App\Service\IParser;
use GuzzleHttp\Client;
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
        $check   = new ErrorNodeEmpty();

        foreach ($this->links['content'] as $k=>$link) {
            $html    = file_get_contents($link);

            $crawler = new Crawler(null, $link);
            $crawler->addHtmlContent($html, 'UTF-8');


            $content[$k]['title'] = $check($crawler->filter('.detail-title'))->text();
            $content[$k]['text']  = $check($crawler->filter('.short-description'))->text();
            $content[$k]['price'] = $check($crawler->filter('.detail-price-uah > meta')->first())->attr('content');
            $content[$k]['image'] = $crawler->filter('.detail-img-thumbs-l-i')->each(function (Crawler $node, $i) {
                $check = new ErrorNodeEmpty();
                return $check($node->children('a'))->attr('href');
            });
        }

        return $content;
    }

}
