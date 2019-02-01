<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 01.02.19
 * Time: 2:20
 */

namespace App\Service\Error\ErrorCrawler;

use App\Service\IError;

class ErrorNodeEmpty implements IError
{
    private $answer;

    public function __construct()
    {
        $this->answer = new NodeAnswerNull();
    }

    public function __invoke($crawler)
    {

        return $crawler->count() > 0 ? $crawler : $this->answer;
    }
}
