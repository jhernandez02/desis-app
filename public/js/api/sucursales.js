const sucursalesApiUrl = '/api/sucursales';

function getSucursalesByBodegaId(id) {
    ajaxRequest({
        url: `${sucursalesApiUrl}/bodega/${id}`,
        method: 'GET',
        success: function (data) {
            console.log('Sucursales:', data);
            let html = '<option value=""></option>';
            for (const sucursal of data) {
                html += `<option value="${sucursal.id}">${sucursal.descripcion}</option>`;
            }
            document.querySelector('#inputSucursal').innerHTML = html;
        },
        error: function (err) {
            console.error('Error al obtener sucursales:', err);
        }
    });
}
