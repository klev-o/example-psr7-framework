<?php

use Framework\Template\TemplateRenderer;
use Framework\Template\Twig\Extension\MixExtension;

return [
    'dependencies' => [
        'factories' => [
            TemplateRenderer::class => Infrastructure\Framework\Template\TemplateRendererFactory::class,
            Twig\Environment::class => Infrastructure\Framework\Template\Twig\TwigEnvironmentFactory::class,
            MixExtension::class => Infrastructure\App\Twig\MixExtensionFactory::class,
        ],
    ],

    'views' => [
        'extension' => '.html.twig',
    ],

    'twig' => [
        'template_dir' => 'views',
        'cache_dir' => 'var/cache/twig',
        'extensions' => [
            MixExtension::class
        ],
    ],

    'mix' => [
        'root' => 'public/build',
        'manifest' => 'mix-manifest.json',
    ],

];