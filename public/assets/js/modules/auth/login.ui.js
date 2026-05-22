import { showAlert } from "../../components/alert.js";
import { showLoader, hideLoader } from "../../components/loader.js";

export function startLoader() {
    showLoader("Iniciando sesión...");
}

export function stopLoader() {
    hideLoader();
}

export function showError(message) {
    showAlert(message, "error");
}

export function showSuccess(message) {
    showAlert(message, "success");
}

export function resetForm() {
    const form = document.getElementById("loginForm");
    if (form) form.reset();
}