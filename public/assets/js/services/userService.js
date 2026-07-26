import { post } from "../core/http.js";
import { BASE_URL } from "../core/config.js";

export function createUser(data) {
    return post(`${BASE_URL}/users/store`, data);
}