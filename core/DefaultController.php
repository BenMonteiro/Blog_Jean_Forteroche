<?php

class DefaultController
{

    public function renderView(string $template = '', array $data = []): void
    {
        extract($data);
        include $template;
    }

}