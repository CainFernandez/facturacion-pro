import { login } from "./login.controller.js";

export function initLoginEvents() {

    const form = document.getElementById("loginForm");
    if (!form) return;

    form.addEventListener("submit", handleSubmit);
}

function handleSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);

    login(formData);
}