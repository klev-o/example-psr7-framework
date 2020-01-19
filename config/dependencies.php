<?php

use App\Http\Middleware;
use Framework\Container\Container;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Router;
use Zend\Diactoros\Response;

/** @var Container $container */
$container->set(Application::class, function (Container $container) {
    return new Application(
        $container->get(MiddlewareResolver::class),
        $container->get(Router::class),
        new Middleware\NotFoundHandler()
    );
});
$container->set(Router::class, function () {
    return new AuraRouterAdapter(new Aura\Router\RouterContainer());
});
$container->set(MiddlewareResolver::class, function (Container $container) {
    return new MiddlewareResolver(new Response(), $container);
});
$container->set(Middleware\BasicAuthMiddleware::class, function (Container $container) {
    return new Middleware\BasicAuthMiddleware($container->get('config')['users'], new Response());
});
$container->set(Middleware\ErrorHandlerMiddleware::class, function (Container $container) {
    return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
});
