<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:26
 */

namespace App\Service;

use App\Service\Parser\Rozetka\PageParserService;
use App\Service\Parser\Rozetka\ProductParserService;

class Crawler implements ICrawler
{
    const PARSER = [
        PageParserService::NAME    => PageParserService::class,
        ProductParserService::NAME => ProductParserService::class
    ];

    public function execute($link)
    {
        $data = [];
        foreach (self::PARSER as $class) {
            $instance = new $class($link);
            /** @var IParser $instance */
            $data[$instance::NAME] = $instance->parse();
            $link = $data[$instance::NAME];
        }

        return $data;
    }
}
