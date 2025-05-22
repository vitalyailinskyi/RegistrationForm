<?php

namespace Src;

class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . "/views/$view.php";
    }
}