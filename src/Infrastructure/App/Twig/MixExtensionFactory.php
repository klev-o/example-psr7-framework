<?php

namespace Infrastructure\App\Twig;

use App\Template\Twig\Extension\MixExtension;
use Psr\Container\ContainerInterface;

class MixExtensionFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['mix'];

        return new MixExtension(
            $config['root'],
            $config['manifest']
        );
    }
}