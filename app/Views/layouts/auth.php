<?php

/** @var string $viewPath */ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app.css">

</head>

<body class="auth-body" data-page="login"></body>

<div class="auth-container">

    <?php require_once $viewPath; ?>

</div>

<script
    type="module"
    src="<?= BASE_URL ?>/assets/js/app.js">
</script>

</body>

</html>