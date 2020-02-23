<?php

namespace Infrastructure\Framework\Http\Pipeline;

use Framework\Http\Pipeline\MiddlewareResolver;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;

class MiddlewareResolverFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new MiddlewareResolver(new Response(), $container);
    }
}