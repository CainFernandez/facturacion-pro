import { showAlert } from "../../components/alert.js";
import { showLoader, hideLoader } from "../../components/loader.js";
import { BASE_URL } from "../../core/config.js";


export function startLoader(message = "Procesando...") {
    showLoader(message);
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


/**
 * 🔍 Renderizar usuarios en la tabla
 */
export function renderUsers(users) {

    const tableBody = document.getElementById("usersTableBody");

    if (!tableBody) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Sin resultados
    |--------------------------------------------------------------------------
    */

    if (users.length === 0) {

        tableBody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align: center;">
                    No se encontraron usuarios
                </td>
            </tr>
        `;

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Crear filas
    |--------------------------------------------------------------------------
    */

    tableBody.innerHTML = users.map((user) => {

        const isActive = user.status === "active";


        const statusText = isActive
            ? "Activo"
            : "Inactivo";


        const statusClass = isActive
            ? "badge-success"
            : "badge-danger";


        const buttonText = isActive
            ? "Desactivar"
            : "Activar";


        const buttonClass = isActive
            ? "btn-danger"
            : "btn-success";


        const nextStatus = isActive
            ? "inactive"
            : "active";


        return `
            <tr>

                <td>
                    ${user.id}
                </td>

                <td>
                    ${escapeHtml(user.name)}
                </td>

                <td>
                    ${escapeHtml(user.username)}
                </td>

                <td>
                    ${escapeHtml(user.email)}
                </td>

                <td>
                    ${escapeHtml(user.role_name)}
                </td>

                <td>
                    <span
                        class="badge user-status ${statusClass}"
                        data-user-id="${user.id}">
                        ${statusText}
                    </span>
                </td>

                <td>

                    <a
                        href="${BASE_URL}/users/edit?id=${user.id}"
                        class="btn btn-sm btn-primary">
                        Editar
                    </a>

                    <button
                        type="button"
                        class="btn btn-sm ${buttonClass} btn-toggle-status"
                        data-id="${user.id}"
                        data-status="${nextStatus}"
                        data-name="${escapeHtml(user.name)}">
                        ${buttonText}
                    </button>

                </td>

            </tr>
        `;

    }).join("");
}


/**
 * 🔐 Escapar HTML
 */
function escapeHtml(value) {

    const div = document.createElement("div");

    div.textContent = value ?? "";

    return div.innerHTML;
}