<?php

namespace App\Http\Controllers;

use App\Service\Parser\NewsParserService;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Service\Parser\ProductParserService;

class HomeController extends Controller
{
    private $link;
    private $page;
    private $count;

    private $parser;

    private $html;

    public function __construct(NewsParserService $parser)
    {
        $this->link  = 'https://hi-news.ru/';
        $this->page  = 'page/';
        $this->count = 2;

        $this->parser = $parser;

    }

    public function index()
    {
        $array = [];

        for ($i = 1; $i <= $this->count; $i++) {
            $array[] = $this->parser->parse($this->link.$this->page.$i);
        }

        dd($array);
        return view('welcome');
    }
}
