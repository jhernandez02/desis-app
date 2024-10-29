const productosApiUrl = '/api/productos';

function getProductos() {
    ajaxRequest({
        url: productosApiUrl,
        method: 'GET',
        success: function (data) {
            console.log('Productos:', data);
            let html = '';
            for (const producto of data) {
                html += `<tr>
                            <td>${producto.nombre}</td>
                            <td>${producto.materiales}</td>
                            <td class="txt-center">${producto.codigo}</td>
                            <td class="txt-center">${producto.precio} ${producto.moneda}</td>
                            <td class="txt-center">${producto.bodega}</td>
                            <td class="txt-center">${producto.sucursal}</td>
                            <td class="txt-center">
                                <button type="button" class="btnEditar" title="Editar">&#9998;</button>
                                <button type="button" class="btnEliminar" title="Eliminar">&#x1F5D1;</button>
                            </td>
                        </tr>`;
            }
            document.querySelector('tbody').innerHTML = html;
        },
        error: function (err) {
            console.error('Error al obtener productos:', err);
        }
    });
}

function getProductoById(id) {
    fetch(`${productosApiUrl}/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Producto no encontrado');
            }
            return response.json();
        })
        .then(data => {
            console.log('Producto:', data);
        })
        .catch(error => console.error('Error:', error));
}

function getProductoExist(codigo) {
    return new Promise((resolve, reject) => {
        ajaxRequest({
            url: `${productosApiUrl}/exist/${codigo}`,
            method: 'GET',
            success: function (data) {
                resolve(data);
            },
            error: function (err) {
                console.error('Error:', err);
                reject(new Error('Producto no encontrado'));
            }
        });
    });
}

function createProducto(producto) {
    console.log('createProducto:', producto);
    return new Promise((resolve, reject) => {
        ajaxRequest({
            url: productosApiUrl,
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            data: producto,
            success: function (data) {
                console.log('Producto creado:', data);
                resolve(data);
            },
            error: function (err) {
                console.error('Error al crear el producto:', err);
                reject(new Error('Error al crear el producto'));
            }
        });
    });
}


function updateProducto(id, producto) {
    fetch(`${productosApiUrl}/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(producto)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al actualizar el producto');
        }
        return response.json();
    })
    .then(data => {
        console.log('Producto actualizado:', data);
    })
    .catch(error => console.error('Error:', error));
}

function deleteProducto(id) {
    fetch(`${productosApiUrl}/${id}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al eliminar el producto');
        }
        return response.json();
    })
    .then(data => {
        console.log('Producto eliminado:', data);
    })
    .catch(error => console.error('Error:', error));
}