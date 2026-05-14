<?php /** @var array $users */ ?>

<div class="page-header">

    <div class="page-title">
        <h1>Usuarios</h1>
        <p>Administración de usuarios del sistema</p>
    </div>

    <div class="page-actions">
        <input 
            type="text" 
            class="table-search" 
            placeholder="Buscar usuario..."
        >

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
                    <td>
                        <span class="badge <?= $user['status'] === 'active' ? 'badge-success' : 'badge-danger'; ?>">
                            <?= $user['status']; ?>
                        </span>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>