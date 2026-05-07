<?php /** @var string $viewPath */ /*✅ $viewPath es la ruta de la vista que se va a renderizar, definida en Controller.php */ ?> 

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div style="display:flex;">

    <?php require_once __DIR__ . '/../partials/sidebar.php'; ?>

    <main style="flex:1; padding:20px;">
        <?php require_once $viewPath; ?>
    </main>

</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
