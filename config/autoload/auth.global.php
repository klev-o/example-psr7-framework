<?php

use App\Http\Middleware\BasicAuthMiddleware;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            BasicAuthMiddleware::class => function (ContainerInterface $container) {
                return new BasicAuthMiddleware($container->get('config')['auth']['users'], new Response());
            },
        ],
    ],

    'auth' => [
        'users' => [],
    ],
];