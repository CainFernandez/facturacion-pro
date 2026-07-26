<?php

/** @var array $roles */ ?>

<div class="form-container">

    <div class="form-card">

        <h1 class="form-title">👤 Crear nuevo usuario</h1>
        <p class="form-subtitle">Complete los datos para registrar un usuario en el sistema</p>

        <div id="alertContainer" class="alert-container"></div>

        <form id="userForm" class="form-grid">

            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="name" placeholder="Ej: Juan Pérez" required>
            </div>

            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" placeholder="Ej: juanperez" required>
            </div>

            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" placeholder="Ej: correo@empresa.com" required>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="form-group col-2">
                <label>Rol del sistema</label>
                <select name="role_id" required>
                    <option value="">Seleccionar rol</option>

                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id']; ?>">
                            <?= $role['description']; ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary">Guardar</button>
                <a class="btn btn-danger" href="<?= BASE_URL ?>/users">Cancelar</a>
            </div>

        </form>

    </div>

</div>