<?php

namespace App\Service\Parser\Rozetka;

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
        $header = [
            'User-Agent'       => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',
            'Headers'          => ['Content-Type' => 'application/x-www-form-urlencoded'],
            'Accept-Language'  => 'ru-RU,ru;q=0.8,en-US;q=0.2,en;q=0.1',
            'Accept-Charset'   => 'utf-8',
            'Content-Language' => 'ru',
            'Accept-Encoding'  => 'gzip',
            'exceptions'       => false,
        ];

        foreach ($this->links['content'] as $k=>$link) {
            $html    = file_get_contents($link);

            $crawler = new Crawler(null, $link);
            $crawler->addHtmlContent($html, 'UTF-8');

            try {
                $content[$k]['title'] = $crawler->filter('.detail-title')->text();
                $content[$k]['text']  = $crawler->filter('.short-description')->text();
                $content[$k]['price'] = $crawler->filter('.detail-price-uah > meta')->first()->attr('content');
                $content[$k]['image'] = $crawler->filter('.detail-img-thumbs-l-i')->each(function (Crawler $node, $i) {
                    return $node->children('a')->attr('href');
                });

            } catch (\InvalidArgumentException $e) {
                // Handle the current node list is empty..
            }

        }


        return $content;
    }

}
