<?php

class DefaultController
{

    public function getView($template, $view)
    {
        ob_start();
        if (file_exists('./src/views/'.$view.'.html')) {
            require_once './src/views/'.$view.'.html';
        }
        $content = ob_get_contents();
        ob_end_clean();
        $this->renderView($template, ['content' => $content]);
    }

    public function renderView($template, array $data = []): void
    {
        extract($data);
        if (file_exists($template)) {
            require_once $template;
        }
    }
}