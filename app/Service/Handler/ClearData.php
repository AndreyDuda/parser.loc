<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 01.02.19
 * Time: 10:36
 */

namespace App\Service\Handler;

use App\Service\IHandler;
use App\Service\Parser\Rozetka\ProductParserService;

class ClearData implements IHandler
{
    public function __invoke($data)
    {
        $contents = [];

        foreach ($data as $i => $item) {
            foreach ($item[ProductParserService::NAME] as $k=>$content) {
                $contents[$i][$k]['title'] = $content['title'];
                $contents[$i][$k]['code']  = $content['code'];
                $contents[$i][$k]['price'] = $content['price'];
                $contents[$i][$k]['text']  = $content['text'];

                foreach ($content['image'] as $index => $image) {
                    $contents[$i][$k]['image'][$index] = $image;
                }
            }
        }
        dd($contents);

        return $contents;

    }
}
