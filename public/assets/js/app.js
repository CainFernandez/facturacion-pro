import { loadLoginPage } from "./pages/login-page.js";

document.addEventListener("DOMContentLoaded", () => {

    const page = document.body.dataset.page;

    if (page === "login") {
        loadLoginPage();
    }
});