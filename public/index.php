<?php

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Initialization
$request = ServerRequestFactory::fromGlobals();

### Action
$action = null;
$path = $request->getUri()->getPath();

if ($path === '/') {

    $action = function (ServerRequestInterface $request) {
        $name = $request->getQueryParams()['name'] ?? 'Guest';
        return new HtmlResponse('Hello, ' . $name . '!');
    };

} elseif ($path === '/cat') {

    $action = function () {
        return new HtmlResponse('I am a cat');
    };


} elseif ($path === '/blog') {

    $action = function () {
        return new JsonResponse([
            ['id' => 1, 'title' => '1 Post'],
            ['id' => 2, 'title' => '2 Post'],
        ]);
    };

} elseif (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {

    $request = $request->withAttribute('id', $matches['id']);

    $action = function (ServerRequestInterface $request) {
        $id = $request->getAttribute('id');
        if ($id > 2) {
            return new JsonResponse(['error' => 'Undefined page'], 404);
        }
        return new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
    };

}

if ($action) {
    $response = $action($request);
} else {
    $response = new HtmlResponse('Undefined page', 404);
}

### Postprocessing
$response = $response->withHeader('X-MyHeader', 'Hello World');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);