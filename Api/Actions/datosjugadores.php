<?php
require_once('../Helpers/Base.php');
require_once('../Helpers/Validator.php');
require_once('../models/modeljugador.php');

//comproboar si existe acción a realizar
if (isset($_GET['action'])){
 //se crea una sesión
 session_start();
 $jugador= new jugador;
 $result = array('status'=> 0, 'message'=> null, 'exception' => null );
 if (isset($_SESSION('IdUser')) OR true){
    $result['sseion']= 1;
    switch ($_GET['action']){
        case'readAll';
            if ($result['dataset']= $jugador->readAll()){
                $result['status']= 1;
            } elseif (Database::getException()){
                $result['exception']=Database::getException();
            } else{
                $result['exception']= 'No hay datos registrados';
            }
            break;
        case 'seach';
            $_POST= $jugador->validateForm($_POST);
            if($_POST['search']==''){
                $result['exception']='Ingrese un valor para buscar';
            } elseif ($result['dataset']=$jugador->searchRow($_POST['search'])){
                $result['status']= 1;
                $result['message']='Valor encontrado';
            }elseif(Database::getException()){
                $result['exception']=Database::getExection();
            }else{
                $result['exception']= 'No hay coincidencias';
            }
            break;
        case 'create':
            $_POST= $jugador-> validateForm($_POST);
            if(!$jugador->setnombrejugador($_POST['nombrej'])){
                $result['exception']='Nombre incorrecto';
            }elseif(!$jugador->setapellidojugador($_POST['apellidoj'])){
                $result['exception']='Apellido incorrecto';
            } elseif (!$jugador->setedadjugador($_POST['edadj'])){
                $result['exception']='Edad equivocada';
            }elseif(!$jugador->setasistencias($_POST['asistenciasj'])){
                $result['exception']='asistencias equivocadas';
            }elseif(!$jugador->setgolesmarcados($_POST['golesj'])){
                $result['exception']='goles incorrectos';
            }elseif(!$jugador->setminutosjugados($_POST['minutosj'])){
                $result['exception']='minutos equivocados';
            }elseif(!$jugador->setestatus(isset($_POST['estatus'])?1:0)){
                $result['exception']='estatus equivocado';
            }elseif(!$jugador->setequipo($_POST['equipoj'])){
                $result['exception']='equipo equivocado';
            }elseif(!$jugador->setpais($_POST['pais'])){
                $result['exception']='pais equivocado';
            }elseif(!$jugador->setposicion($_POST['posicion'])){
                $result['exception']='posicion equivocada';
            }elseif(!$jugador->setequipo($_POST['equipoj'])){
                $result['exception']='Equipo equivocado';
            }elseif(!$jugador->setpais($_POST['paisj'])){
                $result['exception']='Pais equivocado';
            }elseif(!is_uploaded_file($_FILES['archivo'])){
             $result['exception']='Seleccione una imagen';   
            } elseif (!$jugador->setimg($_FILES['archivo'])){
                $result['exception']=$jugador->getFileError();
            }elseif($jugador->createRow()){
                $result['status']=1;
                if($jugador->saveFile($_FILES['archivo'],$jugador->getRuta(), $jugador->getimg())){
                    $result['message']='jugador guardado correctamente';
                }else {
                    $result['message']='jugador guardado pero no se guardó la imagen';
                }
            
            }else {
                $result['exception']=Databse::gerException();;
            }
            break;
        case 'readOne':
            if(!$jugador->setidjugador($_POST['IdPlayer'])){
                $result['exception']= 'jugador incorrecto';
            } elseif ($result[dataset]=$jugador->readOne()){
                $result['status'] = 1;
            }elseif(Database::getException()){
                $result['exception']=Database::getException();
            }else{
                $result['exception']='producto inexistente';
            }
            break;
        case 'update':
            $_POST =$jugador->validateForm($_POST);
            if(!$jugador->setidjugador($_POST['IdPlayer'])){
                $result['exception']= 'Jugador incorrecto';
            } elseif (!$data=$jugador->readOne()){
                $result['exception']='Producto inexistente';
            } elseif(!$jugador->setnombrejugador($_POST['NameP'])){
                $result['exception']='Nombre incorrecto';
            } elseif(!$jugador->setapellidojugador($_POST['LasP'])){
                $result['exception']='Apellido incorrecto';
            }elseif(!$jugador->setedadjugador($_POST['AgeP'])){
                $result['exception']='Edad incorrecta';
            }elseif(!$jugador->setasistencias($_POST['AsistP'])){
                $result['exception']='Asistencias incorrectas';
            }elseif(!$jugador->setgolesmarcados($_POST['GoalsP'])){
                $result['exception']='Goles incorrectos';
            }elseif(!$jugador->setminutosjugados($_POST['MinsPlayed'])){
                $result['exception']='Minutos incorrecto';
            }elseif(!$jugador->setestatus($_POST['StatusP'])){
                $result['exception']='Estado incorrecto';
            }elseif(!$jugador->setequipo($_POST['Idteam'])){
                $result['exception']='Equipo incorrecto';
            }elseif(!$jugador->setpais($_POST['IdCtry'])){
                $result['exception']='Pais incorrecto';
            } elseif(!$jugador->setposicion($_POST['IdPos'])){
                $result['exception'='Posicion incorrecta']
            } elseif(!$jugador->setimg($_FILES['ImgP'])){
                $result['exception']=$jugador->getFileError();
            }elseif($jugador->updateRow($data['ImgP'])){
                $result['status']=1;
                
                if ($jugador->saveFile($_FILES['ImgP'],$jugador->getRuta(), $jugador->getimagenes())){
                    $result['message']='Jugador modificado correctamente';
                }else {
                    $result['message']='Jugador modificado pero no se guardó la imagen';
                }
            } else {
                $result['exception'] = Database::getException();
            }
            break;
        case 'delete':
            if(!$jugador->setidjugador($_POST['IdPlayer'])){
                $result['exception']= 'Jugador incorrecto';
            }elseif (!$data=$jugador->readOne()){
                $result['exception']='Jugador inexistente';
            }elseif ($jugador->deleteRow()){
                $result['status']=1;
            
                if ($jugador->deleteFile($jugador->getRuta(), $data['ImgP'])){
                $result['message']='Jugador eliminado correctamente;'
                }else {
                    $result['message']= 'Jugador eliminado pero no se borró la imagen';
                }
            } else {
                $result['exception']=Database::getException();
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



/*
{
//Obtener datos del formulario
$nombrejugador= $_POST['nombrej'];
$apellidojugador= $_POST['apellidoj'];
$edadjugador= $_POST['floatingInputGrid'];
 =$_POST['minutosj '];
$statusjugador = $_POST['status'];
//$asistenciasjugadorjs= $POST['aistenciasjugador'];

//Obtener datos del formulario para actualizar
$nombrejugadoracjs =$_POST['nombrejugadorac'];
$apellidojugadoracjs= $_POST['apellidojgugadorac'];
$edadjugadoracjs= $_POST['edadjugadoracjs'];
$minutosjugadosacjs = $_POST['minutosjugadosac'];


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para agregar jugador
$sql = "INSERT INTO  tbPlayer (IdPla, NameP, LastP , AgeP,AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos)
values ('$nombrejugador','$apellidojugador','$edadjugador', , , '$minutosjugadosjs, , $statusjugador,( select IdTeam from tbTeams where TeamName = 'barca' ),( select IdCtry from tbCountry where CtryName = 'salvador' ), 14, 15)";


// Hacer consulta SQL para actualizar jugador

$sql = "UPDATE tbPlayer SET NameP ='$nombrejugadoracjs', WHERE IdPLayer =  "



// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
}
*/

?>
