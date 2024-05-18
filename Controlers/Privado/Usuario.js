// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LISTA = SERVER + '/Actions/ActionsUserC.php?action=';
const ENDPOINT_GENERO = 'http://localhost/Proyecto-ADS-V02/Api/Actions/ActionsGender.php?action=readAll';
const ENDPOINT_Credenciales = 'http://localhost/Proyecto-ADS-V02/Api/Actions/ActionsCredenciales.php?action=readAll';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {

    // Se llama a la función que muestra el historial
    readRows(API_LISTA);
});
// Para mostrar los productos recientes
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr>
        <td>${row.IdVot}</td>
        <td>${row.NameV}</td>
        <td>${row.LastV}</td>
        <td>${row.DuiV}</td>
        <td>${row.Gender}</td>
        <td>${row.UserC}</td>
        <td>
        <div class="btn-group">
        <button type="button" class="btn btn-primary btn-floating" data-bs-toggle="modal"
            data-bs-target="#Edit" data-mdb-ripple-init>
            <i class="fas fa-magic"></i></button>
        <button type="button" class="btn btn-danger btn-floating" data-bs-toggle="modal"
            data-bs-target="#Delete" data-mdb-ripple-init>
            <i class="fa-solid fa-trash"></i></button>
    </div>
    </td>
        </tr>
        `;

    });

    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('usuarios-tabla').innerHTML = content;
}


// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
    // Se asigna el título para la caja de diálogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar Votante';
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_GENERO, 'Genero', null);
    fillSelect(ENDPOINT_Credenciales, 'Credenciales', null);
}

function openCreate2() {
    // Se asigna el título para la caja de diálogo (modal).
    document.getElementById('modal-title').textContent = 'Agregar Credenciales';
    // Se llama a la función que llena el select del formulario. Se encuentra en el archivo components.js
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form2').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    (document.getElementById('id2').value) ? action = 'update' : action = 'create2';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_LISTA, action, 'save-form2', 'save-modal2');
});
// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    (document.getElementById('id').value) ? action = 'update' : action = 'create';
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_LISTA, action, 'save-form', 'save-modal');
});
  





