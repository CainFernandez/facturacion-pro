<?php

/** @var string $viewPath */ ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Facturación PRO</title>

    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/app.css">

</head>

<body data-page="users-create">

    <div class="app-layout">

        <!-- Sidebar -->
        <?php require_once __DIR__ . '/../partials/sidebar.php'; ?>

        <div class="app-main">

            <!-- Header -->
            <?php require_once __DIR__ . '/../partials/header.php'; ?>

            <!-- Content -->
            <main class="app-content">

                <?php require_once $viewPath; ?>

            </main>

        </div>

    </div>

    <script
        type="module"
        src="<?= BASE_URL ?>/assets/js/app.js">
    </script>

</body>

</html>