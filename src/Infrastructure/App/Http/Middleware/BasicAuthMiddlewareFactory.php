<?php

namespace Infrastructure\App\Http\Middleware;

use App\Http\Middleware\BasicAuthMiddleware;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;

class BasicAuthMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new BasicAuthMiddleware($container->get('config')['auth']['users'], new Response());
    }
}