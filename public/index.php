<?php

use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

### Initialization
$request = ServerRequestFactory::fromGlobals();

### Action
$path = $request->getUri()->getPath();
if ($path === '/') {
    $name = $request->getQueryParams()['name'] ?? 'Guest';
    $response = new HtmlResponse('Hello, ' . $name . '!');
} elseif ($path === '/cat') {
    $response = new HtmlResponse('I am a cat');

} elseif ($path === '/blog') {
    $response = new JsonResponse([
        ['id' => 1, 'title' => 'The First Post'],
        ['id' => 2, 'title' => 'The Second Post'],
    ]);
} elseif (preg_match('#^/blog/(?P<id>\d+)$#i', $path, $matches)) {
    $id = $matches['id'];
    if ($id > 2) {
        $response = new JsonResponse(['error' => 'Undefined page'], 404);
    } else {
        $response = new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
    }
} else {
    $response = new HtmlResponse('Undefined page', 404);
}

### Postprocessing
$response = $response->withHeader('X-MyHeader', 'Hello World');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);