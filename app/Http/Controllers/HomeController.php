<?php

namespace App\Http\Controllers;

use App\Service\Run\RozetkaProcess;

class HomeController extends Controller
{
    private $link;
    private $page;
    private $count;

    private $parser;

    private $html;

    public function __construct()
    {
        $this->link  = 'https://hi-news.ru/';
        $this->page  = 'page/';
        $this->count = 2;



    }

    public function index()
    {
        $array = [];
/*
        $crawler = new \App\Service\Crawler();
        $crawler->execute();*/

        $process = new RozetkaProcess();
        $process->run();

       /* for ($i = 1; $i <= $this->count; $i++) {
            $array[] = $this->parser->parse($this->link.$this->page.$i);
        }

        dd($array);*/
        return view('welcome');
    }
}
