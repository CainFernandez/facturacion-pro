import { post } from "../core/http.js";
import { BASE_URL } from "../core/config.js";

export function loginRequest(data) {
    return post(`${BASE_URL}/login`, data);
}