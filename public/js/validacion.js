function validarCantidadTexto(texto, min, max) {
    if(texto.length < min || texto.length > max){
        return false;
    }
    return true;
}

function validarFormatoCodigo(codigo) {
    const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
    return regex.test(codigo);
}

async function validarExisteCodigo(codigo) {
    const response = await getProductoExist(codigo);
    return response.message;
}

function validarFormatoPrecio(precio) {
    const regex = /^[0-9]+(\.[0-9]{1,2})?$/;
    return regex.test(precio);
}

const inputCodigo = document.getElementById('inputCodigo');
const inputNombre = document.getElementById('inputNombre');
const inputBodega = document.getElementById('inputBodega');
const inputSucursal = document.getElementById('inputSucursal');
const inputMoneda = document.getElementById('inputMoneda');
const inputPrecio = document.getElementById('inputPrecio');
const inputDescripcion = document.getElementById('inputDescripcion');

async function validarDatos(){
    let materiales = [];
    const inputMateriales = document.querySelectorAll('.inputMaterial');

    // Validaciones Codigo
    if(inputCodigo.value==''){
        alert('El código del producto no puede estar en blanco.');
        inputCodigo.focus();
        return;
    }
    if(!validarFormatoCodigo(inputCodigo.value)){
        alert("El código del producto debe contener letras y números");
        inputCodigo.focus();
        return;
    }
    if(!validarCantidadTexto(inputCodigo.value, 5, 15)){
        alert("El código del producto debe tener entre 5 y 15 caracteres.");
        inputCodigo.focus();
        return;
    }
    const existeCodigo = await validarExisteCodigo(inputCodigo.value);
    if(existeCodigo){
        alert("El código del producto ya está registrado.");
        inputCodigo.focus();
        return;
    }

    // Validaciones Nombre
    if(inputNombre.value==''){
        alert('El nombre del producto no puede estar en blanco.');
        inputNombre.focus();
        return;
    }
    if(!validarCantidadTexto(inputNombre.value, 2, 50)){
        alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
        inputNombre.focus();
        return;
    }

    // Validaciones Bodega
    if(inputBodega.value==''){
        alert("Debe seleccionar una bodega.");
        inputBodega.focus();
        return;
    }

    // Validaciones Sucursal
    if(inputSucursal.value==''){
        alert("Debe seleccionar una sucursal.");
        inputSucursal.focus();
        return;
    }

    // Validaciones Moneda
    if(inputMoneda.value==''){
        alert("Debe seleccionar una moneda.");
        inputMoneda.focus();
        return;
    }

    // Validaciones Precio
    if(inputPrecio.value==''){
        alert('El precio del producto no puede estar en blanco.');
        inputPrecio.focus();
        return;
    }
    if(!validarFormatoPrecio(inputPrecio.value)){
        alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
        inputPrecio.focus();
        return;
    }

    // Validaciones Materiales
    for (i = 0; i < inputMateriales.length; i++) {
        console.log('value: ',inputMateriales[i].value);
        if(inputMateriales[i].checked) {
            materiales.push(inputMateriales[i].value);
        }
    }
    if(materiales.length<2){
        console.log(inputMateriales);
        alert('Debe seleccionar al menos dos materiales para el producto.');
        return;
    }

    // Validaciones Descripcion
    if(inputDescripcion.value==''){
        alert('La descripción del producto no puede estar en blanco.');
        inputDescripcion.focus();
        return;
    }
    if(!validarCantidadTexto(inputDescripcion.value, 10, 1000)){
        alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
        inputDescripcion.focus();
        return;
    }

    const datos = {
        codigo: inputCodigo.value,
        nombre: inputNombre.value,
        sucursal_id: inputSucursal.value,
        moneda_id: inputMoneda.value,
        precio: inputPrecio.value,
        descripcion: inputDescripcion.value,
        materiales: materiales
    }
    return datos;
}

function limpiarFormulario(){
    inputCodigo.value = '';
    inputNombre.value = '';
    inputBodega.value = '';
    inputSucursal.value = '';
    inputMoneda.value = '';
    inputPrecio.value = '';
    inputDescripcion.value = '';
    const inputMateriales = document.querySelectorAll('.inputMaterial');
    for (i = 0; i < inputMateriales.length; i++) {
        inputMateriales[i].checked = false;
    }
}