
let modalElement = null;


/**
 * Crear el modal
 */
function createModal() {

    if (modalElement) {
        return;
    }

    modalElement = document.createElement("div");

    modalElement.className = "modal";

    modalElement.innerHTML = `
        <div class="modal-content">

            <div class="modal-header">

                <h2 id="modalTitle">
                    Confirmar acción
                </h2>

                <button
                    type="button"
                    class="modal-close"
                    id="modalClose">
                    &times;
                </button>

            </div>


            <div class="modal-body">

                <p id="modalMessage">
                    ¿Está seguro de realizar esta acción?
                </p>

            </div>


            <div class="modal-actions">

                <button
                    type="button"
                    class="btn btn-secondary"
                    id="modalCancel">
                    Cancelar
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="modalConfirm">
                    Confirmar
                </button>

            </div>

        </div>
    `;


    document.body.appendChild(modalElement);


    /*
    |--------------------------------------------------------------------------
    | Cerrar modal
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("modalClose")
        .addEventListener("click", closeModal);


    document
        .getElementById("modalCancel")
        .addEventListener("click", closeModal);


    /*
    |--------------------------------------------------------------------------
    | Cerrar haciendo clic fuera del modal
    |--------------------------------------------------------------------------
    */

    modalElement.addEventListener("click", (event) => {

        if (event.target === modalElement) {
            closeModal();
        }

    });

}


/**
 * Abrir modal de confirmación
 */
export function showConfirmModal({
    title = "Confirmar acción",
    message = "¿Está seguro de realizar esta acción?",
    confirmText = "Confirmar",
    cancelText = "Cancelar",
    confirmClass = "btn-primary",
    onConfirm = null
} = {}) {

    createModal();


    /*
    |--------------------------------------------------------------------------
    | Obtener elementos
    |--------------------------------------------------------------------------
    */

    const titleElement =
        document.getElementById("modalTitle");

    const messageElement =
        document.getElementById("modalMessage");

    const confirmButton =
        document.getElementById("modalConfirm");

    const cancelButton =
        document.getElementById("modalCancel");


    /*
    |--------------------------------------------------------------------------
    | Configurar contenido
    |--------------------------------------------------------------------------
    */

    titleElement.textContent = title;

    messageElement.textContent = message;

    confirmButton.textContent = confirmText;

    cancelButton.textContent = cancelText;


    /*
    |--------------------------------------------------------------------------
    | Configurar clase del botón
    |--------------------------------------------------------------------------
    */

    confirmButton.className =
        `btn ${confirmClass}`;


    /*
    |--------------------------------------------------------------------------
    | Limpiar evento anterior
    |--------------------------------------------------------------------------
    */

    const newConfirmButton =
        confirmButton.cloneNode(true);

    confirmButton.replaceWith(newConfirmButton);


    /*
    |--------------------------------------------------------------------------
    | Evento confirmar
    |--------------------------------------------------------------------------
    */

    newConfirmButton.addEventListener("click", async () => {

        if (typeof onConfirm === "function") {

            await onConfirm();

        }

        closeModal();

    });


    /*
    |--------------------------------------------------------------------------
    | Mostrar modal
    |--------------------------------------------------------------------------
    */

    modalElement.classList.add("show");

}


/**
 * Cerrar modal
 */
export function closeModal() {

    if (!modalElement) {
        return;
    }

    modalElement.classList.remove("show");

}

