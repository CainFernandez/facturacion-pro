import {
    storeUser,
    editUser,
    changeUserStatus,
    searchUsersController
} from "./users.controller.js";

import { showConfirmModal } from "../../components/modal.js";


export function bindUserEvents() {

    /*
    |--------------------------------------------------------------------------
    | Crear usuario
    |--------------------------------------------------------------------------
    */

    const createForm = document.getElementById("userForm");

    if (createForm) {

        createForm.addEventListener("submit", (e) => {

            e.preventDefault();

            const data = new FormData(createForm);

            storeUser(data);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Editar usuario
    |--------------------------------------------------------------------------
    */

    const editForm = document.getElementById("userEditForm");

    if (editForm) {

        editForm.addEventListener("submit", (e) => {

            e.preventDefault();

            const data = new FormData(editForm);

            editUser(data);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | Buscar usuario en tiempo real
    |--------------------------------------------------------------------------
    */
    const searchInput =
        document.getElementById("userSearch");

    let searchTimeout = null;

    if (searchInput) {

        searchInput.addEventListener("input", () => {

            const search =
                searchInput.value.trim();


            // Cancelar búsqueda anterior
            clearTimeout(searchTimeout);


            // Esperar 300 ms antes de buscar
            searchTimeout = setTimeout(() => {

                searchUsersController(search);

            }, 300);

        });

    }


    /*
  |--------------------------------------------------------------------------
  | Activar / Desactivar usuario
  |--------------------------------------------------------------------------
  */

    const usersTableBody =
        document.getElementById("usersTableBody");

    if (usersTableBody) {

        usersTableBody.addEventListener("click", (e) => {

            const button =
                e.target.closest(".btn-toggle-status");

            // Si el clic no fue sobre un botón de estado
            if (!button) {
                return;
            }

            const id =
                button.dataset.id;

            const status =
                button.dataset.status;

            const name =
                button.dataset.name;


            const isActivating =
                status === "active";


            /*
            |--------------------------------------------------------------------------
            | Configuración del modal
            |--------------------------------------------------------------------------
            */

            const title =
                isActivating
                    ? "Activar usuario"
                    : "Desactivar usuario";


            const message =
                isActivating
                    ? `¿Está seguro de activar al usuario "${name}"?`
                    : `¿Está seguro de desactivar al usuario "${name}"?`;


            const confirmText =
                isActivating
                    ? "Activar"
                    : "Desactivar";


            const confirmClass =
                isActivating
                    ? "btn-success"
                    : "btn-danger";


            /*
            |--------------------------------------------------------------------------
            | Mostrar modal
            |--------------------------------------------------------------------------
            */

            showConfirmModal({

                title,

                message,

                confirmText,

                confirmClass,


                /*
                |--------------------------------------------------------------------------
                | Confirmar acción
                |--------------------------------------------------------------------------
                */

                onConfirm: async () => {

                    const success = await changeUserStatus(
                        id,
                        status
                    );


                    if (!success) {
                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Buscar estado de la misma fila
                    |--------------------------------------------------------------------------
                    */

                    const statusElement = document.querySelector(
                        `.user-status[data-user-id="${id}"]`
                    );


                    if (!statusElement) {

                        console.error(
                            "No se encontró el estado del usuario:",
                            id
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Usuario activado
                    |--------------------------------------------------------------------------
                    */

                    if (status === "active") {

                        // Cambiar texto del estado
                        statusElement.textContent = "Activo";

                        // Cambiar clases del estado
                        statusElement.classList.remove("badge-danger");
                        statusElement.classList.add("badge-success");

                        // Cambiar botón
                        button.textContent = "Desactivar";

                        button.classList.remove("btn-success");
                        button.classList.add("btn-danger");

                        // Próxima acción
                        button.dataset.status = "inactive";

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Usuario desactivado
                    |--------------------------------------------------------------------------
                    */

                    else {

                        // Cambiar texto del estado
                        statusElement.textContent = "Inactivo";

                        // Cambiar clases del estado
                        statusElement.classList.remove("badge-success");
                        statusElement.classList.add("badge-danger");

                        // Cambiar botón
                        button.textContent = "Activar";

                        button.classList.remove("btn-danger");
                        button.classList.add("btn-success");

                        // Próxima acción
                        button.dataset.status = "active";
                    }

                }

            });

        });

    }

}

