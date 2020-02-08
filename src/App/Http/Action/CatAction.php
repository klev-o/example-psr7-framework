<?php

namespace App\Http\Action;

use Zend\Diactoros\Response\HtmlResponse;
use Framework\Template\TemplateRenderer;

class CatAction
{
    private $template;

    public function __construct(TemplateRenderer $template)
    {
        $this->template = $template;
    }

    public function __invoke()
    {
        return new HtmlResponse($this->template->render('cat'));
    }
}