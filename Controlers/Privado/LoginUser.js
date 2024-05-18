// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_User = SERVER +'/Actions/ActionsUser.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    fetch(API_User + 'verificarConexion', {
        method: 'get',
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    Swal.fire({
                        title: 'Conexión exitosa',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    Swal.fire({
                        title: 'Error de conexión',
                        text: response.exception,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});

document.getElementById('session-form').addEventListener('submit', function (event) {
    event.preventDefault();

    fetch(API_User + 'logIn', {
        method: 'post',
        body: new FormData(document.getElementById('session-form'))
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    Swal.fire({
                        title: "¡Inicio de sesión exitoso!",
                        text: response.message,
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Continuar"
                    }).then(function () {
                        window.location.href = "menupriv.html";
                    });
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: response.exception,
                        icon: "error",
                        confirmButtonColor: "#dc3545",
                        confirmButtonText: "Aceptar"
                    });
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});


