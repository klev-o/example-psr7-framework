<?php

use Framework\Container\Container;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Application;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Http\Action;
use App\Http\Middleware;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Configuration

$container = new Container();
$container->set('config', [
    'debug' => true,
    'users' => ['admin' => 'password'],
]);

$container->set('middleware.basic_auth', function (Container $container) {
    return new Middleware\BasicAuthMiddleware($container->get('config')['users'], new Response());
});
$container->set('middleware.error_handler', function (Container $container) {
    return new Middleware\ErrorHandlerMiddleware($container->get('config')['debug']);
});

### Initialization

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', Action\HelloAction::class);
$routes->get('cat', '/cat', Action\CatAction::class);
$routes->get('cabinet', '/cabinet', Action\CabinetAction::class);
$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
$routes->get('blog.show', '/blog/{id}', Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);


$router = new AuraRouterAdapter($aura);
$resolver = new MiddlewareResolver(new Response());

$app = new Application($resolver, new Middleware\NotFoundHandler());

$app->pipe($container->get('middleware.error_handler'));
$app->pipe(Middleware\ProfilerMiddleware::class);
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(new Framework\Http\Middleware\RouteMiddleware($router));
$app->pipe('cabinet', $container->get('middleware.basic_auth'));
$app->pipe(new Framework\Http\Middleware\DispatchMiddleware($resolver));

### Running
$request = ServerRequestFactory::fromGlobals();
$response = $app->handle($request);

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);