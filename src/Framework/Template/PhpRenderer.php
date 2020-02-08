<?php

namespace Framework\Template;

class PhpRenderer implements TemplateRenderer
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render($name, array $params = []): string
    {
        $_templateFile_ = $this->path . '/' . $name . '.php';
        ob_start();
        extract($params, EXTR_OVERWRITE);
        require $_templateFile_;
        return ob_get_clean();
    }
}