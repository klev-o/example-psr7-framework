<?php

namespace App\Http\Action\Blog;

use App\ReadModel\PostReadRepository;
use Framework\Template\TemplateRenderer;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class IndexAction implements RequestHandlerInterface
{
    private $posts;
    private $template;

    public function __construct(PostReadRepository $posts, TemplateRenderer $template)
    {
        $this->posts = $posts;
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $posts = $this->posts->getAll();

        return new HtmlResponse($this->template->render('app/blog/index', [
            'posts' => $posts,
        ]));
    }
}