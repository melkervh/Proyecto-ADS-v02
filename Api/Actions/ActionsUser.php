<?php
session_start();
require_once('../Helpers/Base.php');
require_once('../Helpers/validator.php');
require_once('../models/ModelsUser.php');

$response = ['status' => false, 'message' => '', 'exception' => ''];

if (isset($_GET['action'])) {
    $usuario = new Usuario();
    
    switch ($_GET['action']) {
        case 'verificarConexion':
            $response['status'] = true;
            $response['message'] = 'Conexión exitosa a la base de datos.';
            break;

        case 'logIn':
            if (isset($_POST['correo']) && isset($_POST['clave'])) {
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                
                $userId = $usuario->checkCredentials($correo, $clave);
                if ($userId) {
                    $_SESSION['UserId'] = $userId; // Guarda el ID del usuario en la sesión
                    $response['status'] = true;
                    $response['message'] = 'Inicio de sesión exitoso.';
                } else {
                    $response['exception'] = 'Correo electrónico o contraseña incorrectos.';
                }
            } else {
                $response['exception'] = 'Por favor, complete todos los campos.';
            }
            break;
        case 'getSessionState':
            $response['status'] = true;
            $response['session'] = isset($_SESSION['UserId']); // Verifica si la sesión está iniciada
            break;
            case 'logOut':
                session_destroy();
                $response['status'] = true;
                $response['message'] = 'Sesión cerrada correctamente.';
                break;
        default:
            $response['exception'] = 'Acción no disponible dentro de la API.';
    }
} else {
    $response['exception'] = 'No se ha especificado una acción.';
}

echo json_encode($response);
?>

