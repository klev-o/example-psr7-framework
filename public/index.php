<?php

use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteMap;
use Framework\Http\Router\SimpleRouter;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Http\Action;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Initialization

$routes = new RouteMap();

$routes->get('home', '/', Action\HelloAction::class);
$routes->get('about', '/cat', Action\CatAction::class);
$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
$routes->get('blog.show', '/blog/{id}', Action\Blog\ShowAction::class, ['id' => '\d+']);


$router = new SimpleRouter($routes);
$resolver = new ActionResolver();

### Running
$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $handler = $result->getHandler();
    /** @var callable $action */
    $action = $resolver->resolve($result->getHandler());
    $response = $action($request);
} catch (RequestNotMatchedException $e){
    $response = new HtmlResponse('Undefined page', 404);
}

### Postprocessing
$response = $response->withHeader('X-MyHeader', 'Hello World');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);