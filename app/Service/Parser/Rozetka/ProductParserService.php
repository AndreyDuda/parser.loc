<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.01.19
 * Time: 23:25
 */

namespace App\Service\Parser\Rozetka;

use App\Service\IParser;

class ProductParserService implements IParser
{
    const NAME = 'ProductParserService';

    public function parse()
    {
        return self::NAME;
    }

}
