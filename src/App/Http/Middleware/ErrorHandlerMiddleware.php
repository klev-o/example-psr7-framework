<?php

namespace App\Http\Middleware;

use Framework\Template\TemplateRenderer;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class ErrorHandlerMiddleware
{
    private $debug;
    private $template;

    public function __construct(bool $debug, TemplateRenderer $template)
    {
        $this->debug = $debug;
        $this->template = $template;
    }
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            $view = $this->debug ? 'error/error-debug' : 'error/error';
            return new HtmlResponse($this->template->render($view, [
                'request' => $request,
                'exception' => $e,
            ]), $e->getCode() ?: 500);
        }
    }
}