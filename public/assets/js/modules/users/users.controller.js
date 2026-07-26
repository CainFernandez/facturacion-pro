import { createUser } from "../../services/userService.js";
import {
    startLoader,
    stopLoader,
    showError,
    showSuccess
} from "./users.ui.js";

export async function storeUser(formData) {

    try {

        startLoader();

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