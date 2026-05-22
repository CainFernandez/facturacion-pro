export async function post(url, data) {
    const res = await fetch(url, {
        method: "POST",
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        },
        body: data
    });

    return await res.json();
}