import { get, post } from "../core/http.js";
import { BASE_URL } from "../core/config.js";

export function createUser(data) {
    return post(`${BASE_URL}/users/store`, data);
}

export function updateUser(data) {
    return post(`${BASE_URL}/users/update`, data);
}

export function toggleUserStatus(data) {
    return post(
        `${BASE_URL}/users/toggle-status`,
        data
    );
}

/**
 * 🔍 Buscar usuarios
 */
export function searchUsers(search) {
    const url = `${BASE_URL}/users/search?q=${encodeURIComponent(search)}`;

    return get(url);
}