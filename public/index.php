<?php

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteMap;
use Framework\Http\Router\Router;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use App\Http\Action;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Initialization

$routes = new RouteMap();

$routes->get('home', '/', new Action\HelloAction());
$routes->get('about', '/cat', new Action\CatAction());
$routes->get('blog', '/blog', new Action\Blog\IndexAction());
$routes->get('blog.show', '/blog/{id}', new Action\Blog\ShowAction(), ['id' => '\d+']);


$router = new Router($routes);

### Running
$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    /** @var callable $action */
    $action = $result->getHandler();
    $response = $action($request);
} catch (RequestNotMatchedException $e){
    $response = new HtmlResponse('Undefined page', 404);
}

### Postprocessing
$response = $response->withHeader('X-MyHeader', 'Hello World');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);