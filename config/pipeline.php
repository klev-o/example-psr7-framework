<?php

use App\Http\Middleware;
use Framework\Http\Application;

/** @var Laminas\ServiceManager\ServiceManager $container */
/** @var Application $app */

//$app->pipe($container->get(Middleware\ErrorHandlerMiddleware::class));
//$app->pipe(Middleware\ErrorHandlerMiddleware::class);
$app->pipe(Framework\Http\Middleware\ErrorHandler\ErrorHandlerMiddleware::class);
$app->pipe(Middleware\ResponseLoggerMiddleware::class);
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Middleware\ProfilerMiddleware::class);

$app->pipe(Framework\Http\Middleware\BodyParamsMiddleware::class);

//$app->pipe($container->get(Framework\Http\Middleware\RouteMiddleware::class));

$app->pipe(Framework\Http\Middleware\RouteMiddleware::class);


//$app->pipe('cabinet', $container->get(Middleware\BasicAuthMiddleware::class));
$app->pipe('cabinet', Middleware\BasicAuthMiddleware::class);

//$app->pipe(Middleware\EmptyResponseMiddleware::class);
//$app->pipe($container->get(Framework\Http\Middleware\DispatchMiddleware::class));
$app->pipe(Framework\Http\Middleware\DispatchMiddleware::class);
