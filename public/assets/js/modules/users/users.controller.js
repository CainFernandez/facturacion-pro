import {
    createUser,
    updateUser
} from "../../services/userService.js";

import {
    startLoader,
    stopLoader,
    showError,
    showSuccess
} from "./users.ui.js";


/*
|--------------------------------------------------------------------------
| Crear usuario
|--------------------------------------------------------------------------
*/

export async function storeUser(formData) {

    try {

        startLoader("Creando usuario...");

        const result = await createUser(formData);

        stopLoader();

        if (!result.success) {
            showError(result.message);
            return;
        }

        showSuccess(result.message);

        document.getElementById("userForm").reset();

    } catch (error) {

        stopLoader();

        showError(error.message || "Error de conexión");

    }

}


/*
|--------------------------------------------------------------------------
| Actualizar usuario
|--------------------------------------------------------------------------
*/
export async function editUser(formData) {

    try {

        startLoader("Actualizando usuario...");

        const result = await updateUser(formData);

        stopLoader();

        if (!result.success) {
            showError(result.message);
            return;
        }

        showSuccess(result.message);

    } catch (error) {

        stopLoader();

        showError(error.message || "Error de conexión");

    }

}

