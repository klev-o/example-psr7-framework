<?php

use Framework\Template\TemplateRenderer;

return [
    'dependencies' => [
        'factories' => [
            TemplateRenderer::class => Infrastructure\Framework\Template\TemplateRendererFactory::class,
            Twig\Environment::class => Infrastructure\Framework\Template\Twig\TwigEnvironmentFactory::class,
        ],
    ],

    'views' => [
        'extension' => '.html.twig',
    ],

    'twig' => [
        'template_dir' => 'views',
        'cache_dir' => 'var/cache/twig',
        'extensions' => [],
    ],
];