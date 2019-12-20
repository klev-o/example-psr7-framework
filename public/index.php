<?php

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Pipeline\Pipeline;
use Framework\Http\Pipeline\MiddlewareResolver;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Http\Action;
use App\Http\Middleware;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Initialization

$config = [
    'users' => ['admin' => 'password'],
];

$aura = new Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', Action\HelloAction::class);
$routes->get('cat', '/cat', Action\CatAction::class);
$routes->get('cabinet', '/cabinet', [
    Middleware\ProfilerMiddleware::class,
    new Middleware\BasicAuthMiddleware($config['users']),
    Action\CabinetAction::class,
]);
$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
$routes->get('blog.show', '/blog/{id}', Action\Blog\ShowAction::class)->tokens(['id' => '\d+']);

$router = new AuraRouterAdapter($aura);
$resolver = new MiddlewareResolver();

### Running
$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handlers = $result->getHandler();
    $pipeline = new Pipeline();
    foreach (is_array($handlers) ? $handlers : [$handlers] as $handler) {
        $pipeline->pipe($resolver->resolve($handler));
    }
    $response = $pipeline($request, new Middleware\NotFoundHandler());
} catch (RequestNotMatchedException $e){
    $handler = new Middleware\NotFoundHandler();
    $response = $handler($request);
}

### Postprocessing
$response = $response->withHeader('X-MyHeader', 'Hello World');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);