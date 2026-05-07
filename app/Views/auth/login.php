<div class="login-card">

    <div class="login-header">
        <h1>Facturación PRO</h1>
        <p>Inicia sesión para continuar</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/login" class="login-form">

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="admin@test.com"
                required>
        </div>

        <div class="form-group">
            <label>Contraseña</label>

            <input
                type="password"
                name="password"
                placeholder="••••••••"
                required>
        </div>

        <button type="submit" class="btn-login">
            Ingresar
        </button>

    </form>

</div>