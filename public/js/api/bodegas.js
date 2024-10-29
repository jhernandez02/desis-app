const bodegasApiUrl = '/api/bodegas';

/*function getBodegas() {
    fetch(bodegasApiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener bodegas');
            }
            return response.json();
        })
        .then(data => {
            console.log('Bodegas:', data);
            let html = '<option value="">Seleccione una opción</option>';
            for (const bodega of data) {
                html+= `<option value="${bodega.id}">${bodega.descripcion}</option>`;
            }
            document.querySelector('#inputBodega').innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
}*/

function getBodegas() {
    ajaxRequest({
        url: bodegasApiUrl,
        method: 'GET',
        success: function (data) {
            console.log('Bodegas:', data);
            let html = '<option value="">Seleccione una opción</option>';
            for (const bodega of data) {
                html += `<option value="${bodega.id}">${bodega.descripcion}</option>`;
            }
            document.querySelector('#inputBodega').innerHTML = html;
        },
        error: function (err) {
            console.error('Error al obtener bodegas:', err);
        }
    });
}
