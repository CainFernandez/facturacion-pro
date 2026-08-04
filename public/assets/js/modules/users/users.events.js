import {
    storeUser,
    editUser
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
    | Activar / Desactivar usuario
    |--------------------------------------------------------------------------
    */

    const statusButtons =
        document.querySelectorAll(".btn-toggle-status");

    statusButtons.forEach((button) => {

        button.addEventListener("click", () => {

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
                    ? `¿Está seguro de activar al usuario "${name}" ? `
                    : `¿Está seguro de desactivar al usuario "${name}" ? `;


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

                    console.log("ID:", id);

                    console.log("Nuevo estado:", status);

                    console.log("Usuario:", name);

                }

            });

        });

    });

}

