<?php

namespace App\Http\Action;

use Framework\Template\TemplateRenderer;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use App\Http\Middleware\BasicAuthMiddleware;

class CabinetAction
{
    private $template;

    public function __construct(TemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $username = $request->getAttribute(BasicAuthMiddleware::ATTRIBUTE);


        return new HtmlResponse($this->template->render('cabinet', [
            'name' => $username
        ]));
    }
}