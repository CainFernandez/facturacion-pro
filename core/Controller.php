<?php

namespace Core;

class Controller
{

    public function view($view, $data = [])
    {

        extract($data);

        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "Vista no encontrada: $view";
        }
    }
}