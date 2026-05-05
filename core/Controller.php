<?php

namespace Core;

class Controller {

    public function view($view, $data = []) {

        extract($data);

        // ✅ definir ruta de la vista
        $viewPath = __DIR__ . '/../app/Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            die("Vista no encontrada: $view");
        }

        // 🔥 IMPORTANTE: incluir layout con la variable disponible
        require __DIR__ . '/../app/Views/layouts/main.php';
    }
}