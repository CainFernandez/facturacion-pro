import { loginRequest } from "../../services/authService.js";
import {
    startLoader,
    stopLoader,
    showError,
    showSuccess,
    resetForm
} from "./login.ui.js";

import { BASE_URL } from "../../core/config.js";

export async function login(formData) {

    try {

        startLoader();

        const result = await loginRequest(formData);

        stopLoader();

        if (!result.success) {
            showError(result.message);
            resetForm();
            return;
        }

        showSuccess(result.message);

        setTimeout(() => {
            window.location.href =
                `${BASE_URL}${result.redirect || "/dashboard"}`;
        }, 800);

    } catch (error) {

        stopLoader();

        showError("Error de conexión con el servidor");

        console.error(error);
    }
}