<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    private $link;
    private $page;
    private $count;

    public function __construct()
    {
        $this->link  = 'https://hi-news.ru/';
        $this->page  = 'page/';
        $this->count = 2;

    }

    public function index()
    {
        $array = [];

        for ($i = 1; $i <= $this->count; $i++) {
            $array[] = $this->getLinks($this->link.$this->page.$i);
        }

        dd($array);
        return view('welcome');
    }

    public function getLinks($link)
    {


        $array = [];


        $html = file_get_contents($link);
        $crawler = new Crawler(null, $link);
        $crawler->addHtmlContent($html, 'UTF-8');

        $title = $crawler->filter('div > h2')->text();


        $links = $crawler->filter('#main > #content')->each(function (Crawler $node, $i) {
            return $node->filter('h2 > a')->each(function (Crawler $node, $i) {
                return $node->attr('href');
            });
        });
        /*dd($links);*/
        foreach ($links[0] as $link)
        {

          $array[] = $this->getContent($link);

        }

        return $array;

    }

    public function getContent($link)
    {
        $data = [];

        $html = file_get_contents($link);
        $crawler = new Crawler(null, $link);
        $crawler->addHtmlContent($html, 'UTF-8');

        $data['title'] = $crawler->filter('.single-title')->text();
        $data['content'] = $crawler->filter('.text')->text();
        $data['image'] = $crawler->filter('.text > p > img')->attr('src');

        $data['image'] = $crawler->filter('.text img')->each( function (Crawler $node, $i) {
            return 'http:'.$node->attr('src');
        });

        return $data;
    }




}
