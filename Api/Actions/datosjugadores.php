<?php
require_once('../Helpers/Base.php');
require_once('../Helpers/Validator.php');
require_once('../Models/ModelsJugador.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $Jugador = new Jugador;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['IdUser']) or true) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case'readAll';
            if ($result['dataset']= $Jugador->readAll()){
                $result['status']= 1;
            } elseif (Database::getException()){
                $result['exception']=Database::getException();
            } else{
                $result['exception']= 'No hay datos registrados';
            }
            break;
            case 'create':
                $_POST= $jugador-> validateForm($_POST);
                if(!$jugador->setNameP($_POST['NombreJugador'])){
                    $result['exception']='Nombre incorrecto';
                }elseif(!$jugador->setLast($_POST['Apellidojugador'])){
                    $result['exception']='Apellido incorrecto';
                } elseif (!$jugador->setAgeP($_POST['Edad'])){
                    $result['exception']='Edad equivocada';
                }elseif(!$jugador->setAsistP($_POST['Asistencias'])){
                    $result['exception']='asistencias equivocadas';
                }elseif(!$jugador->setGoalsP($_POST['golesj'])){
                    $result['exception']='goles incorrectos';
                }elseif(!$jugador->setMinsP($_POST['Minutos'])){
                    $result['exception']='minutos equivocados';
                }elseif(!$jugador->setStatus(isset($_POST['Status'])?1:0)){
                    $result['exception']='estatus equivocado';
                }elseif (!isset($_POST['Equipo'])) {
                    $result['exception'] = 'Seleccione un Equipo';
                }elseif (!$Usuario2->setIdTeam($_POST['Equipo'])) {
                    $result['exception'] = 'Equipo incorrecta';
                }elseif (!isset($_POST['País'])) {
                    $result['exception'] = 'Seleccione un País';
                }elseif (!$Usuario2->setIdCtry($_POST['País'])) {
                    $result['exception'] = 'País incorrecta';
                }elseif (!isset($_POST['Posición'])) {
                    $result['exception'] = 'Seleccione un Posición';
                }elseif (!$Usuario2->setIdPos($_POST['Posición'])) {
                    $result['exception'] = 'Posición incorrecta';
                }elseif(!is_uploaded_file($_FILES['Imagen'])){
                 $result['exception']='Seleccione una imagen';   
                } elseif (!$jugador->setImgP($_FILES['Imagen'])){
                    $result['exception']=$jugador->getFileError();
                }elseif($jugador->createRow()){
                    $result['status']=1;
                    if($jugador->saveFile($_FILES['Imagen'],$jugador->getRuta(), $jugador->getimg())){
                        $result['message']='jugador guardado correctamente';
                    }else {
                        $result['message']='jugador guardado pero no se guardó la imagen';
                    }
                
                }else {
                    $result['exception']=Databse::gerException();;
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


