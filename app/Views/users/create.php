<h1>Nuevo usuario</h1>

<form method="POST" action="<?= BASE_URL ?>/users">

    <input type="text" name="name" placeholder="Nombre" required>

    <input type="text" name="username" placeholder="Usuario" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="password" name="password" placeholder="Contraseña" required>

    <select name="role_id" required>
        <option value="1">Administrador</option>
        <option value="2">Supervisor</option>
    </select>

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>

</form>