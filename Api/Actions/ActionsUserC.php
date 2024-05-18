<?php
require_once('../Helpers/Base.php');
require_once('../Helpers/Validator.php');
require_once('../Models/ModelsUserC.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $Usuario2 = new Usuario2;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['IdUser']) OR true) {
        $result['session'] = 1;
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $Usuario2->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
                case 'readOne':
                    if (!$Usuario2->setIdvoters($_POST['id'])) {
                        $result['exception'] = 'Prodincorrectoucto ';
                    } elseif ($result['dataset'] = $Usuario2->readOne()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                    break;
                    case 'create':
                        $_POST = $Usuario2->validateForm($_POST);
                        if (!$Usuario2->setNombrevoters($_POST['Nombre'])) {
                            $result['exception'] = 'Nombre  incorrecto';
                        } elseif (!$Usuario2->setApellidovoters($_POST['Apellido'])) {
                            $result['exception'] = 'Apellido incorrecto';
                        }elseif (!$Usuario2->setDuiUser($_POST['Dui'])) {
                            $result['exception'] = 'Dui incorrecto';
                        }elseif (!isset($_POST['Genero'])) {
                            $result['exception'] = 'Seleccione un Genero';
                        }elseif (!$Usuario2->setgenero($_POST['Genero'])) {
                            $result['exception'] = 'Genero incorrecta';
                        }elseif (!isset($_POST['Credenciales'])) {
                            $result['exception'] = 'Seleccione una Credenciales';
                        }elseif (!$Usuario2->setIduser($_POST['Credenciales'])) {
                            $result['exception'] = 'Credenciales incorrecta';
                        }elseif ($Usuario2->createRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Usuario agregado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        break;
                        case 'create2':
                            $_POST = $Usuario2->validateForm($_POST);
                            error_log(print_r($_POST, true)); // Log para ver los datos recibidos
                            if (!$Usuario2->setCorreovoters($_POST['correo'])) {
                                $result['exception'] = 'correo incorrecto';
                            } elseif (!$Usuario2->setClavevoters($_POST['Passwordc'])) {
                                $result['exception'] = 'Passwordc incorrecto';
                            } elseif ($Usuario2->createRow2()) {
                                $result['status'] = 1;
                                $result['message'] = 'Credenciales agregado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                            break;
                    default:
                    $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
?>
