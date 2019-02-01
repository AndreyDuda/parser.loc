<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 01.02.19
 * Time: 2:16
 */

namespace App\Service;

interface IError
{
    public function __invoke($crawler);
}
