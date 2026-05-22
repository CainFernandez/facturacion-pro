const loginBtn = document.getElementById("loginBtn");

export function showLoader(text = "Ingresando...") {

    if (!loginBtn) return;

    loginBtn.disabled = true;
    loginBtn.dataset.text = loginBtn.textContent;

    loginBtn.innerHTML = `
        <span class="spinner"></span> ${text}
    `;
}

export function hideLoader() {

    if (!loginBtn) return;

    loginBtn.disabled = false;
    loginBtn.innerHTML = loginBtn.dataset.text || "Ingresar";
}