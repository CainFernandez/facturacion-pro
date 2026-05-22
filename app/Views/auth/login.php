<div class="login-card">

    <div class="login-header">
        <h1>Facturación PRO</h1>
        <p>Inicia sesión para continuar</p>
    </div>

    <div id="alertContainer" class="alert-container"></div>

    <form method="POST"
        action="<?= BASE_URL ?>/login"
        class="login-form"
        id="loginForm">

        <div class="form-group">
            <label>Email o Usuario</label>

            <input
                type="text"
                name="email"
                id="loginInput"
                placeholder="admin@test.com"
                autocomplete="username">
        </div>

        <div class="form-group">

            <label>Contraseña</label>

            <div class="password-wrapper">

                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="••••••••"
                    autocomplete="current-password">
            </div>
        </div>

        <button type="submit" class="btn-login" id="loginBtn">
            Ingresar
        </button>

    </form>

</div>