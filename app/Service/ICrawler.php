<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:31
 */

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;

interface ICrawler
{
    public function execute();
}
