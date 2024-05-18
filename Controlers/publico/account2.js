const API = SERVER + '/Actions/ActionsUser2.php';

document.addEventListener('DOMContentLoaded', function () {
    // Petición para determinar si se ha iniciado sesión.
    fetch(API + '?action=getSessionState', {
        method: 'GET',
        credentials: 'same-origin'
    }).then(function (response) {
        if (response.ok) {
            response.json().then(function (data) {
                if (data.session) {
                    // Mostrar menú de sesión iniciada
                    const header = `
                    <nav class="navbar navbar-expand-lg fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand me-auto" href="menupublic.html"><img
                                src="../../resources/imagenes/FIFA_logo_without_slogan.svg.png" class="imgicon"></a>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img
                                        src="../../resources/imagenes/FIFA_logo_without_slogan.svg.png" class="imgicon"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="menupublic.html">Menu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="votos.html">Votar</a>
                                    </li>
                                    <li class="nav-item">
                                        <button id="logout-button" class="nav-link" >Cerrar Sesión</button> 
                                    </li>
                                    </form>
                            </div>
                        </div>
                        <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                    </div>
                    </button>
                </nav>`;
                    document.querySelector('header').innerHTML = header;

                    // Listener para el botón de cerrar sesión
                    document.getElementById('logout-button').addEventListener('click', function () {
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, cerrar sesión'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(API + '?action=logOut', {
                                    method: 'GET',
                                    credentials: 'same-origin'
                                }).then(function (response) {
                                    if (response.ok) {
                                        response.json().then(function (data) {
                                            if (data.status) {
                                                Swal.fire({
                                                    title: '¡Cerrado!',
                                                    text: 'Tu sesión ha sido cerrada.',
                                                    icon: 'success',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'Aceptar'
                                                }).then(function () {
                                                    window.location.href = 'index.html'; // Redirigir a la página de inicio
                                                });
                                            } else {
                                                Swal.fire({
                                                    title: 'Error',
                                                    text: 'Hubo un problema cerrando la sesión.',
                                                    icon: 'error',
                                                    confirmButtonColor: '#dc3545',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                            }
                                        });
                                    } else {
                                        console.error('Error en la solicitud:', response.status, response.statusText);
                                    }
                                });
                            }
                        });
                    });
                } else {
                    // Mostrar menú de sesión no iniciada
                    const header = `
                    <nav class="navbar navbar-expand-lg fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand me-auto" href="menupublic.html"><img
                                src="../../resources/imagenes/FIFA_logo_without_slogan.svg.png" class="imgicon"></a>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img
                                        src="../../resources/imagenes/FIFA_logo_without_slogan.svg.png" class="imgicon"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="index.html">Login</a>
                                    </li>
                                    </form>
                            </div>
                        </div>
                        <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                    </div>
                    </button>
                </nav>`;
                    document.querySelector('header').innerHTML = header;
                }
            });
        } else {
            console.error('Error en la solicitud:', response.status, response.statusText);
        }
    });
});





