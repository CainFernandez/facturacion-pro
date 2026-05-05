<?php /** @var string $viewPath */ /*✅ $viewPath es la ruta de la vista que se va a renderizar, definida en Controller.php */ ?> 

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<?php require_once $viewPath; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
