<h2>🔐 Iniciar Sesión</h2>

<form method="POST" action="<?= BASE_URL ?>/login">

    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <br>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit">Ingresar</button>

</form>