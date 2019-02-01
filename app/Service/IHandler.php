<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 01.02.19
 * Time: 10:37
 */

namespace App\Service;

interface IHandler
{
    public function __invoke($data);
}
