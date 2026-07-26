import { storeUser } from "./users.controller.js";

export function bindUserEvents() {

    const form = document.getElementById("userForm");

    if (!form) return;

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const data = new FormData(form);

        storeUser(data);
    });
}