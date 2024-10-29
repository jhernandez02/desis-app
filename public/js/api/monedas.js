const monedasApiUrl = '/api/monedas';

function getMonedas() {
    ajaxRequest({
        url: monedasApiUrl,
        method: 'GET',
        success: function (data) {
            console.log('Monedas:', data);
            let html = '<option value="">Seleccione una opción</option>';
            for (const moneda of data) {
                html += `<option value="${moneda.id}">${moneda.descripcion}</option>`;
            }
            document.querySelector('#inputMoneda').innerHTML = html;
        },
        error: function (err) {
            console.error('Error al obtener monedas:', err);
        }
    });
}
