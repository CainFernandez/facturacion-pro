import { loadLoginPage } from "./pages/login-page.js";
import { loadUsersPage } from "./pages/users-page.js";

document.addEventListener("DOMContentLoaded", () => {

    const page = document.body.dataset.page;
    console.log("PAGE:", page);

    if (page === "login") {
        loadLoginPage();
    }

    if (page === "users-create") {
        loadUsersPage();
    }
});