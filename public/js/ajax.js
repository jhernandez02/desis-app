function ajaxRequest({ url, method = 'GET', headers = {}, data = null, success, error }) {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);

    // Establecer los encabezados, si existen
    for (const key in headers) {
        xhr.setRequestHeader(key, headers[key]);
    }

    // Definir el manejador de respuesta
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    const responseData = JSON.parse(xhr.responseText);
                    success && success(responseData);
                } catch (e) {
                    console.error('Error al parsear JSON:', e);
                    error && error(e);
                }
            } else {
                error && error(new Error(`Error en la solicitud: ${xhr.status}`));
            }
        }
    };

    // Capturar errores de conexión
    xhr.onerror = function () {
        error && error(new Error('Error de conexión'));
    };

    // Enviar la solicitud con los datos, si es necesario
    xhr.send(data ? JSON.stringify(data) : null);
}
