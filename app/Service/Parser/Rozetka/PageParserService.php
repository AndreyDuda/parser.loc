<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:25
 */

namespace App\Service\Parser\Rozetka;

use App\Service\IParser;
use Symfony\Component\DomCrawler\Crawler;

class PageParserService implements IParser
{
    const NAME     = 'PageParserService';

    private $links;
    private $count_page;

    public function __construct()
    {
        $this->links      = config('parser.resource.rozetka.categories');
        $this->count_page = config('parser.resource.rozetka.settings.count_page');
    }

    public function parse(): array
    {

        $content = [];
        foreach ($this->links as $k => $link) {

            $html    = file_get_contents($link);
            $crawler = new Crawler(null, $link);
            $crawler->addHtmlContent($html, 'UTF-8');

            $category = preg_replace('/[^ a-zа-яё\d]/ui', '', $crawler->filter('h1')->text());
            $content[$k]['category'] = $category;
            $content[$k]['content']  = $crawler->filter('#catalog_goods_block')->each(function (Crawler $node, $i) {
                return $node->filter('div.g-i-tile-i-title > a')->each(function (Crawler $node, $i) {
                    return $node->attr('href');
                });
            });
        }

        return $content;
    }
}
