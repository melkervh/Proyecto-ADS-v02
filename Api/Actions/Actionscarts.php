<?php
require_once('../Helpers/Base.php');
require_once('../Helpers/Validator.php');
require_once('../Models/ModelsVotos.php');

if (isset($_GET['action'])) {
    session_start();
    $Votos = new Votos;
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION['IdVot']) OR true) {
        $result['session'] = 1;

        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $Votos->ReadJugador()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;

            case 'vote':
                if (isset($_POST['idPla'])) {
                    $idPla = $_POST['idPla'];
                    $idVot = $_SESSION['IdVot']; // Asegúrate de que IdVot esté correctamente definido

                    if ($Votos->vote($idPla, $idVot)) {
                        $result['status'] = 1;
                        $result['message'] = 'El voto se ha registrado correctamente.';
                    } else {
                        $result['message'] = 'Hubo un problema al registrar el voto. Inténtalo de nuevo más tarde.';
                    }
                } else {
                    $result['message'] = 'ID de jugador no proporcionado.';
                }
                break;

            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }

        header('content-type: application/json; charset=utf-8');
        echo json_encode($result);
    } else {
        echo json_encode(array('status' => 0, 'message' => 'Acceso denegado'));
    }
} else {
    echo json_encode(array('status' => 0, 'message' => 'Recurso no disponible'));
}
?>
