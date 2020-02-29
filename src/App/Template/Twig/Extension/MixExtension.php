<?php

namespace App\Template\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MixExtension extends AbstractExtension
{
    private $publicDir;
    private $manifestName;
    private $manifest;

    public function __construct($publicDir = "public", $manifestName = 'mix-manifest.json')
    {
        $this->publicDir = rtrim($publicDir, '/') ;
        $this->manifestName = $manifestName;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('mix', [$this, 'getVersionedFilePath']),
        ];
    }

    public function getVersionedFilePath($file)
    {
        $manifest = $this->getManifest();

        if (!isset($manifest[$file])) {
            throw new \InvalidArgumentException("File {$file} not defined in asset manifest.");
        }
        return $manifest[$file];
    }

    private function getManifest()
    {
        if (is_null($this->manifest)) {
            $manifestPath = $this->publicDir.'/'.$this->manifestName;
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        }
        return $this->manifest;
    }

}
