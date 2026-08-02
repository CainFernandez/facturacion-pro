import {
    storeUser,
    editUser
} from "./users.controller.js";


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

}
