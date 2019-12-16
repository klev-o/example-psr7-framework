<?php

namespace App\Http\Action;

use Zend\Diactoros\Response\HtmlResponse;

class CatAction
{
    public function __invoke()
    {
        return new HtmlResponse('I am a cat');
    }
}