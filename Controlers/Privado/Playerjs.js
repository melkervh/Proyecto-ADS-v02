const API_JUGADORES = SERVER + '../Actions/datosjugadores.php?action=';
ENDPOINT_POSICION = SERVER + '../Actions/posicionaction.php?action=readAll';
ENDPOINT_CIUDAD = SERVER + '../Actions/paisaction.php?action=readAll';
ENDPOINT_TEEM = SERVER + '../Actions/equipoaction.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    openShowProductos();

});
function openShowProductos() {

    // Petición para obtener los datos del registro solicitado.
    fetch(API_JUGADORES + 'readAll', {
        method: 'get'
    }).then(function (request) {

        // Se verifica si la petición es correcta.
        if (request.ok) {
            request.json().then(function (response) {

                let data = [];
                // Se comprueba si la respuesta es satisfactoria.
                if (response.status) {

                    data = response.dataset;
                    let content = '';
                    data.map(function (row) {

                        var StatusP;
                        if (row.StatusP == '1') {
                            StatusP = "Activo";
                        }
                        if (row.StatusP == '0') {
                            StatusP = "Inactivo";
                        }

                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                        <tr>
                            <td class="text-center" >${row.IdPla}</td>
                            <td><img src="${SERVER}/Imagenes/${row.ImgP}" class="materialboxed" height="100"></td>
                            <td class="text-center" >${row.NAmeP}</td>
                            <td class="text-center" >${row.LastP}</td> 
                            <td class="text-center" >${row.AgeP}</td>
                            <td class="text-center" >${row.AsistP}</td>
                            <td class="text-center" >${row.GoalsP}</td>
                            <td class="text-center" >${row.MinsPlayed}</td> 
                            <td class="text-center" >${row.Position}</td>
                            <td class="text-center">${row.StatusP}</td>
                            <td class="text-center">${row.TeamName}</td>
                            <td class="text-center">${row.CtryName}</td>
                            <td>
                            <div class="btn-group">
                            <button onclick="openUpdate(${row.IdPla}) type="button" class="btn btn-primary btn-floating" data-bs-toggle="modal"
                                data-bs-target="#Delete" data-mdb-ripple-init>
                                <i class="fas fa-magic"></i>
                            <button onclick="openDelete(${row.IdPla}) type="button" class="btn btn-danger btn-floating" data-bs-toggle="modal"
                                data-bs-target="#Delete" data-mdb-ripple-init>
                                <i class="fa-solid fa-trash"></i></button>
                        </div>
                        </td>
                            </tr>
                        `
                    });

                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('usuarios-tabla').innerHTML = content;

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

function openCreate() {
    document.getElementById('modal-title').textContent = 'Agregar Usuario';

    //TENGO DUDAA CON LO DE CATEGORIA
    fillSelect(ENDPOINT_POSICION, 'Posición', null);
    fillSelect(ENDPOINT_CIUDAD, 'País', null);
    fillSelect(ENDPOINT_TEEM, 'Equipo', null);
}

//preoarar el formulario al momento de modificar un registro
function openUpdate(IdPla) {
    //asignar el titulo para la caja de dialogo
    document.getElementById('modal-title').textContent = 'Actualizar producto';
    //se establecre el campo como opcional, NO SÉ SI HACE REFERENCIA AL DE IMAGEN 
    document.getElementById('archivo').required = false;
    //se define como un objeto los datos del registro
    const data = new FormData();
    data.append('IdPla', IdPla);
    //para obtener los datos del registro solicitado
    fetch(API_JUGADORES + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {

        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    document.getElementsById('IdPlayer').value = response.dataset.idjugador;
                    document.getElementsById('NameP').value = response.dataset.nombrejugador;
                    document.getElementsById('LastP').value = response.dataset.apellidojugador;
                    document.getElementsById('AgeP').value = response.dataset.edadjugador;
                    document.getElementsById('AsistP').value = response.dataset.asistencias;
                    document.getElementsById('GoalsP').value = response.dataset.golesmarcados;
                    document.getElementsById('MinsPlayed').value = response.dataset.minutosjugados;
                    document.getElementById('StatusP').value = response.data.estatus;
                    //TENGO DUDA CON RESPECTO A SI ASÍ PONGO ESTOS
                    document.getElementsById('IdTeam').value = response.dataset.equipo;
                    document.getElementsById('IdCtry').value = response.dataset.pais;
                    document.getElementsById('IdPos').value = response.dataset.posicion;
                } else {
                    aweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + '' + request.statusText);
        }
    });
}

document.getElementById('save-form').addEventListener('submit', function (event) {
    event.preventDefault();
    let action = '';
    (document.getElementById('Idplayer').value) ? action = 'update' : action = 'create';
    saveRow(API_JUGADORES, action, 'save-form', 'save-modal');
});

function openDelete(IdPla) {
    const data = new FormData();
    data.append('IdPla', IdPla);
    confirmDelete(API_JUGADORES, data);
}

function SaveConfirmationAlert() {
    Swal.fire({
        title: "¿Desea guardar el registro de este jugador?",
        text: "No podrás revertir esta acción.",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Datos guardados!",
                text: "El registro se guardo con éxito.",
                icon: "success"
            });
        }

    });


};
