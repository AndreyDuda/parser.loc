<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:43
 */

namespace App\Service\Run;

use App\Service\Crawler;

class RozetkaProcess
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = new Crawler();
    }

    public function run()
    {
        $this->crawler->execute();
    }
}
