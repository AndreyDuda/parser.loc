<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:43
 */

namespace App\Service\Run;

use App\Service\Crawler;

class RozetkaProcessor implements ProcessorInterface
{
    private $crawler;
    private $links;

    public function __construct()
    {
        $this->crawler = new Crawler();
        $this->links   = config('parser.resource.rozetka.categories');
    }

    public function run()
    {
        $content =[];
        foreach ($this->links as $k =>$link) {

            $content[] = $this->crawler->execute($link);
        }

        dd($content);
    }
}
