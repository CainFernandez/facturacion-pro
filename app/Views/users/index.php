<?php

/** @var array $users */ ?> <!-- Oye, $users existe y es un array -->

<h1>Usuarios</h1>

<a href="<?= BASE_URL ?>/users/create" class="btn btn-primary">
    + Nuevo usuario
</a>

<table class="table">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($users as $user): ?>

            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['role_name']; ?></td>
                <td><?= $user['status']; ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>

</table>