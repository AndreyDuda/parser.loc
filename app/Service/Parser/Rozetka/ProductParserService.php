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
    private $count_content;

    public function __construct($link)
    {
        $this->links = $link;
        $this->count_content = (integer)config('parser.resource.rozetka.settings.count_content');
    }

    public function parse()
    {
        $content = [];
        $check   = new ErrorNodeEmpty();

        foreach ($this->links['content'] as $i=>$links) {

            foreach ($links as $k => $link) {

                if ($k >= $this->count_content && $this->count_content != 0) {
                    break;
                }

                $html = file_get_contents($link);

                $crawler = new Crawler(null, $link);
                $crawler->addHtmlContent($html, 'UTF-8');

                $content[$i][$k]['title'] = $check($crawler->filter('.detail-title'))->text();
                $content[$i][$k]['code']  = $check($crawler->filter('.detail-code-i'))->text();
                $content[$i][$k]['text']  = $check($crawler->filter('.short-description'))->text();
                $content[$i][$k]['price'] = $check($crawler->filter('.detail-price-uah > meta')->first())->attr('content');
                $content[$i][$k]['image'] = $crawler->filter('.detail-img-thumbs-l-i')->each(function (Crawler $node, $i) {
                    $check = new ErrorNodeEmpty();
                    return $check($node->children('a'))->attr('href');
                });
            }
        }

        return $content;
    }

}
