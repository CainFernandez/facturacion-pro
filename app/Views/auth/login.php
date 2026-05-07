<div class="login-card">

    <div class="login-header">
        <h1>Facturación PRO</h1>
        <p>Inicia sesión para continuar</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/login" class="login-form" id="loginForm">

        <div class="form-group">
            <label>Email o Usuario</label>

            <input
                type="text"
                name="login"
                id="loginInput"
                placeholder="admin@test.com"
                required>
        </div>

        <div class="form-group">

            <label>Contraseña</label>

            <div class="password-wrapper">

                <input
                    type="password"
                    name="password"
                    id="passwordInput"
                    placeholder="••••••••"
                    required>

                <button type="button" id="togglePassword">
                    👁️
                </button>

            </div>

        </div>

        <div class="error-message" id="errorMessage"></div>

        <button type="submit" class="btn-login" id="loginBtn">
            Ingresar
        </button>

    </form>

</div>