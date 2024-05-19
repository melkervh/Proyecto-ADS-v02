<?php
require_once('../Helpers/Base.php');
require_once('../Helpers/Validator.php');
require_once('../models/pais.php');

//comproboar si existe acción a realizar
if (isset($_GET['action'])){
 //se crea una sesión
 session_start();
 $pais= new pais;
 $result = array('status'=> 0, 'message'=> null, 'exception' => null );
 if (isset($_SESSION('IdUser')) OR true){
    $result['sseion']= 1;
    switch ($_GET['action']){
        case'readAll';
            if ($result['dataset']= $pais->readAll()){
                $result['status']= 1;
            } elseif (Database::getException()){
                $result['exception']=Database::getException();
            } else{
                $result['exception']= 'No hay datos registrados';
            }
            break;
            default:
        $result['exception']='Acción no disponible dentro dentro de la sesión';
    }
 } else {
    print(json_encode($result));
 }

}else {
    print(json_decode('Recurso no disponible'));
}

?>