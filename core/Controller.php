<?php

namespace Core;

class Controller
{

    public function view($view, $data = [], $layout = 'app')
    {

        extract($data);

        // ✅ definir ruta de la vista
        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("Vista no encontrada");
        }

        // 🔥 IMPORTANTE: incluir layout con la variable disponible
        require_once __DIR__ . '/../app/Views/layouts/' . $layout . '.php';
    }
}
