const API_CARTS = SERVER + '../Actions/Actionscarts.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    openShowProductos();
});

function openShowProductos() {
    fetch(API_CARTS + 'readAll', {
        method: 'get'
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    let data = response.dataset;
                    let content = '';
                    data.forEach(function (row, index) {
                        const modalId = `Info${row.IdPla}`;
                        content += `
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <button class="botnvotar btimg">  
                                    <img src="${SERVER}/Imagenes/${row.ImgP}" class="card-img-top imgjugador" alt="...">
                                </button>
                                <div class="card-body">
                                    <h5 class="card-title titulocar">${row.NAmeP} ${row.LastP}</h5>
                                    <div class="cardP">
                                        <button type="button" class="btadd" onclick="voteConfirmationAlert(${row.IdPla})">Votar</button>
                                        <button type="button" class="btadd" data-bs-toggle="modal" data-bs-target="#${modalId}">Más información</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="${modalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">${row.NAmeP} ${row.LastP}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container InfoPlayer">
                                            <div class="row">
                                                <div class="col-sm stastgraf">
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row InfoTextPlayer">
                                            <p>${row.NAmeP} ${row.LastP} es un talentoso futbolista de ${row.AgeP} años. Actualmente,
                                            juega para el equipo ${row.TeamName}, donde ha demostrado ser una pieza clave 
                                            en el campo. Originario de ${row.CtryName}, ${row.NAmeP} ha acumulado ${row.AsistP} asistencias y ha marcado
                                            ${row.GoalsP} goles a lo largo de la temporada. Su capacidad para mantenerse en el campo es impresionante, 
                                            con un total de ${row.MinsPlayed} minutos jugados. Desempeñándose en la posición de ${row.Position}, 
                                            ${row.NAmeP} continúa mostrando su habilidad y compromiso en cada partido.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class=" DDA" data-bs-toggle="modal" data-bs-target="#Add">Regresar</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    document.getElementById('Targeta').innerHTML = `<div class="row">${content}</div>`;

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}


// Función para enviar el voto al servidor
function sendVote(idPla) {
    fetch(API_CARTS + 'vote', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            idPla: idPla
        })
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status === 1) {
                    // Mostrar alerta de éxito si el voto se registra correctamente
                    Swal.fire({
                        icon: 'success',
                        title: '¡Voto registrado exitosamente!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if (response.status === 2) {
                    // Mostrar alerta si el usuario ya ha votado anteriormente
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ya has votado por este jugador anteriormente',
                    });
                } else {
                    // Mostrar alerta si hay algún otro error
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.exception,
                    });
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

// Función para mostrar la alerta de confirmación antes de votar
function voteConfirmationAlert(idPla) {
    // Mostrar una alerta de confirmación antes de votar
    Swal.fire({
        title: '¿Estás seguro de que deseas votar por este jugador?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, enviar el voto al servidor
            sendVote(idPla);
        }
    });
}


  