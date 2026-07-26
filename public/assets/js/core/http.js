export async function post(url, data) {

    const res = await fetch(url, {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        body: data
    });

    if (!res.ok) {
        throw new Error(`Error HTTP: ${res.status}`);
    }

    return await res.json();
}