const materialesApiUrl = '/api/materiales';

function getMateriales() {
    ajaxRequest({
        url: materialesApiUrl,
        method: 'GET',
        success: function (data) {
            console.log('Materiales:', data);
            let html = '';
            for (const material of data) {
                html += `<input type="checkbox" class="inputMaterial" value="${material.id}" /> ${material.descripcion} `;
            }
            document.querySelector('#materiales').innerHTML = html;
        },
        error: function (err) {
            console.error('Error al obtener materiales:', err);
        }
    });
}
