export function showAlert(message, type = "success") {

    const container = document.getElementById("alertContainer");

    if (!container) return;

    // 🔥 RESET COMPLETO (CLAVE)
    container.innerHTML = "";

    const alertBox = document.createElement("div");
    alertBox.className = `alert alert-${type} show`;
    alertBox.textContent = message;

    container.appendChild(alertBox);

    setTimeout(() => {
        alertBox.classList.remove("show");
        alertBox.remove();
    }, 2500);
}