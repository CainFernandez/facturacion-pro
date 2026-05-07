// ======================================
// 🚨 MOSTRAR MENSAJES EN PANTALLA
// ======================================

export function showError(element, message) {

    element.style.display = 'block';

    element.innerText = message;
}