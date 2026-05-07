// helpers
import { showError } from '../../helpers/alerts.js';

// ===============================
// 👁️ MOSTRAR / OCULTAR PASSWORD
// ===============================

const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('passwordInput');

togglePassword.addEventListener('click', () => {

    const type = passwordInput.type === 'password'
        ? 'text'
        : 'password';

    passwordInput.type = type;
});


// ===============================
// 🔒 VALIDACIÓN SIMPLE LOGIN
// ===============================

const loginForm = document.getElementById('loginForm');

const loginInput = document.getElementById('loginInput');

const errorMessage = document.getElementById('errorMessage');

const loginBtn = document.getElementById('loginBtn');

loginForm.addEventListener('submit', (e) => {

    errorMessage.style.display = 'none';

    // 🔍 validar mínimo 3 caracteres
    if (loginInput.value.trim().length < 3) {

        e.preventDefault();

        showError(
            errorMessage,
            'El usuario o email es muy corto'
        );
    }

    // 🔄 loading UX
    loginBtn.innerText = 'Ingresando...';

    loginBtn.disabled = true;
});