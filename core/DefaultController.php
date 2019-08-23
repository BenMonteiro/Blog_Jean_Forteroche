<?php

class DefaultController
{
    protected $content = '';

    public function renderView($view, array $data = [], $template): void
    {
        ob_start();
        if (file_exists('src/views/'.$view.'.html')){
            require_once 'src/views/'.$view.'.html';
        }
        $this->content = ob_get_contents();
        extract($data);
        if (file_exists($template)){
            include $template;
        }
    }

}