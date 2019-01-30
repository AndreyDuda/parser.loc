<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:25
 */

namespace App\Service\Parser\Rozetka;

use App\Service\IParser;

class PageParserService implements IParser
{
    const NAME = 'PageParserService';

    const category = 'https://hi-news.ru/';

    public function parse()
    {
        $html = file_get_contents(self::category);
        $crawler = new $crawler(null, self::category);
        $crawler->addHtmlContent($html, 'UTF-8');

        $links = $crawler->filter('#main > #content')->each(function (Crawler $node, $i) {
            return $node->filter('h2 > a')->each(function (Crawler $node, $i) {
                return $node->attr('href');
            });
        });

        return $links;
    }
}
