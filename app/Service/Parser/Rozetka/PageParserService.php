<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:25
 */

namespace App\Service\Parser\Rozetka;

use App\Service\Error\ErrorCrawler\ErrorNodeEmpty;
use App\Service\IParser;
use Symfony\Component\DomCrawler\Crawler;

class PageParserService implements IParser
{
    const NAME     = 'PageParserService';

    private $link;
    private $count_page;

    public function __construct($link)
    {
        $this->link       = $link;
        $this->count_page = (integer)config('parser.resource.rozetka.settings.count_page');

    }

    public function parse(): array
    {
        $content = [];
        $link = '';
        $check   = new ErrorNodeEmpty();

        if ($this->count_page < 1) {
            $this->count_page = 1;
        }

        for ($i = 1; $i <= $this->count_page; $i++) {
            $link    = preg_replace('/preset/', 'page=' . $i .';preset', $this->link);
            $html    = file_get_contents($link);
            $crawler = new Crawler(null, $link);
            $crawler->addHtmlContent($html, 'UTF-8');
            $category = $check($crawler->filter('h1'))->text();
            $content['category'][$i] = $category;
            $content['content'][$i]  = $crawler->filter('div.light div.g-i-tile-i-title > a')->each(function (Crawler $node, $i) {
                $check = new ErrorNodeEmpty();
                return $check($node)->attr('href');
            });//paginator-catalog-l-i-active
            $page = $check($crawler->filter('.paginator-catalog-l-i-active')->last())->text();

            if ($page <= $i || $page === null) {
                break;
            }
        }

        return $content;
    }
}
