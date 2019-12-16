<?php

namespace App\Http\Action\Blog;

use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    public function __invoke()
    {
        return new JsonResponse([
            ['id' => 1, 'title' => '1 Post'],
            ['id' => 2, 'title' => '2 Post'],
        ]);
    }
}