<?php

class DefaultController
{

    public function __construct()
    {
        global $twig;
        $this->twig = $twig;
    }

    public function renderView(string $view = '', array $data = []): void
    {
        if (file_exists(ROOT_PATH.'/src/Views/'.$view)) {
        echo $this->twig->render($view, $data);
        }
    }
}