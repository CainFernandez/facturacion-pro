<?php

/** @var array $user */
/** @var array $roles */ ?>

<div class="form-container">

    <div class="form-card">

        <h1 class="form-title">✏️ Editar usuario</h1>
        <p class="form-subtitle">
            Modifique los datos del usuario y guarde los cambios
        </p>

        <div id="alertContainer" class="alert-container"></div>

        <form id="userEditForm" class="form-grid">

            <!-- ID del usuario -->
            <input
                type="hidden"
                name="id"
                value="<?= (int) $user['id']; ?>">

            <div class="form-group">
                <label>Nombre completo</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Ej: Juan Pérez"
                    value="<?= htmlspecialchars($user['name']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Usuario</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Ej: juanperez"
                    value="<?= htmlspecialchars($user['username']); ?>"
                    required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Ej: correo@empresa.com"
                    value="<?= htmlspecialchars($user['email']); ?>"
                    required>
            </div>

            <div class="form-group col-2">
                <label>Rol del sistema</label>

                <select name="role_id" required>

                    <option value="">Seleccionar rol</option>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= $role['id']; ?>"
                            <?= $role['id'] == $user['role_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($role['description']); ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-actions">

                <button
                    type="submit"
                    class="btn btn-primary">
                    Guardar cambios
                </button>

                <a
                    class="btn btn-danger"
                    href="<?= BASE_URL ?>/users">
                    Cancelar
                </a>

            </div>

        </form>

    </div>
</div>