<?php

namespace App\Http\Middleware\ErrorHandler;

use Framework\Template\TemplateRenderer;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Stratigility\Utils;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DebugErrorResponseGenerator implements ErrorResponseGenerator
{
    private $template;
    private $view;

    public function __construct(TemplateRenderer $template, string $view)
    {
        $this->template = $template;
        $this->view = $view;
    }

    public function generate(\Throwable $e, ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render($this->view, [
            'request' => $request,
            'exception' => $e,
        ]), Utils::getStatusCode($e, new Response()));
    }
}