<?php

/** @var array $users */ ?>

<div class="page-header">

    <div class="page-title">
        <h1>Usuarios</h1>
        <p>Administración de usuarios del sistema</p>
    </div>

    <div class="page-actions">
        <input
            type="text"
            class="table-search"
            placeholder="Buscar usuario...">

        <a href="<?= BASE_URL ?>/users/create" class="btn btn-primary">
            + Nuevo usuario
        </a>
    </div>

</div>


<div class="table-card">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td> <?= (int) $user['id']; ?> </td>
                    <td> <?= htmlspecialchars($user['name']); ?> </td>
                    <td> <?= htmlspecialchars($user['username']); ?> </td>
                    <td> <?= htmlspecialchars($user['email']); ?> </td>
                    <td> <?= htmlspecialchars($user['role_name']); ?> </td>

                    <!-- Estado -->
                    <td> <span
                            class="badge <?= $user['status'] === 'active'
                                                ? 'badge-success'
                                                : 'badge-danger'; ?>">
                            <?= $user['status'] === 'active'
                                ? 'Activo'
                                : 'Inactivo'; ?>
                        </span>
                    </td>

                    <!-- Acciones -->
                    <td>
                        <!-- Editar -->
                        <a href="<?= BASE_URL ?>/users/edit?id=<?= (int) $user['id']; ?>"
                            class="btn btn-sm btn-primary"> Editar
                        </a>

                        <!-- Activar / Desactivar -->
                        <?php if ($user['status'] === 'active'): ?>

                            <button
                                type="button" class="btn btn-sm btn-danger btn-toggle-status"
                                data-id="<?= (int) $user['id']; ?>"
                                data-status="inactive"
                                data-name="<?= htmlspecialchars($user['name']); ?>">
                                Desactivar
                            </button>

                        <?php else: ?>

                            <button
                                type="button" class="btn btn-sm btn-success btn-toggle-status"
                                data-id="<?= (int) $user['id']; ?>"
                                data-status="active"
                                data-name="<?= htmlspecialchars($user['name']); ?>">
                                Activar
                            </button>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>