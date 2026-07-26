import { bindUserEvents } from "./users.events.js";

export function initUsers() {
    console.log("INIT USERS OK");
    bindUserEvents();
}