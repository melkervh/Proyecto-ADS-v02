<?php
class jugador extends Validator
{
    //Declarar atributos 
    private $idjugador = null;
    private $nombrejugador = null; 
    private $apellidojugador = null;
    private $edadjugador = null;
    private $asistencias = null;
    private $minutosjugados = null;
    private $estatus = null;
    private $equipo = null;
    private $pais = null ;
    private $posicion = null;
    private $golesmarcados = null; 
    private $img =null;
    private $ruta = '../jugadores/';
    private $iduser= 1;

//metodo para validad 

public function setidjugador($value) 
{
    if ($this-> validateNaturalNumbre ($values)){
      $this -> idjugador = $value;
      return = true;       
    } else {
        return false;
    }
}

public function setnombrejugador($value)
{
    if ( $this->validateString($value,1, 50)){
       $this-> nombrejugador = $value;
       return =true;
    }else {
       return false;
    }
}

public function setapellidojugador($value)
{
    if ($this-> validateString($value,1, 50)) {
        $this-> apellidojugador=$value;
        return true;
    }else {
        return false;
    }
}

public function setedadjugador($value)
{
    if($this->validateAlphanumeric($value,1, 10)){
        $this->edadjugador=$value;
        return true;
    }else {
        return false;
    }
}

public function setasistencias($value)
{
    if($this->validateAlphanumeric($value,1, 999)){
    $this->aistencias = $value;
    return true;
    }else{
        return false;
    }
}

public function setgolesmarcados($value)
{
    if($this->validateAlphanumeric($value,1, 999)){
        $this->golesmarcados=$value;
        return true;
    }else {
        return false;
    }
}
public function setminutosjugados($value)
{
    if($this->validateAlphanumeric($value,1, 999)){
        $this-> minutosjugados =$value;
        return true;
    } else{
        return false;
    }
}

public function setestatus($value)
{
    if($this->validateBoolean($value,1,)){
        $this-> estatus=$value;
        return true;
    } else {
        return false;
    }
}

public function setequipo($value)
{
    if($this->validateString($value, 1, 50)){
       $this->equipo = $value;
       return true; 
    } else {
        return false;
    }
}

public function setpais($value)
{
    if($this->validateString($value,1,50)){
        $this->pais=$value;
        return true;
    } else{
        return false;
    }
}

public function setposicion($value)
{
    if($this->validateString($value,1,50)){
        $this->posicion =$value;
        return true;
    } else{
        return false;
    }
}

public function setimg($file)
{
    if($this->validateImageFile($file,500,500)){
        $this->img=$this->getFileName();
        return true;
    } else{
        return false;
    }
}

public function getIdjugador()
{
    return $this->idusuario;
}

public function getNombreUsuario()
{
    return $this->nombrejugador;
}

public function getApellidoJugador()
{
    return $this->apellidojugador;
}

public function getEdadJugador()
{
    return $this->edadjugador;
}

public function getAsistencias()
{
    return $this->asistencias;
}

public function getMinutosJugados()
{
    return $this-> minutosjugados;
}

public function getEstatus()
{
    return $this-> estatus;
}

public function getEquipo()
{
    return $this-> equipo;
}

public function getPais()
{
    return $this-> pais;
}

public function getPosicion()
{
    return $this-> posicion;
} 

public function getRuta()
{
    return $this-> ruta;
}
public function getimg()
{
    return $this->img;
}

public function createRow()
{
    $sql='INSERT INTO tbPlayer (NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, Img, StatusP, IdTeam, IdCtry, IdUSer, Idpos)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
    $params= array($this->nombrejugador, $this->apellido, $this->edadjugador,$this->asistencias, $this->golesmarcados, $this->minutosjugados, $this->img,$this->estatus,$this->equipo,$this->pais,$this->$iduser,$this->posicion)
    return Database::executeRow($sql,$params);
}

public function searchRows($value)
{
    $sql='SELECT Idplayer, NameP,LasP, AgeP,AsistP,GoalsP,MinsPlayed,ImgP,StatusP,IdTeam,IdCtrym,IdPos
    FROM tbPlayer 
    WHERE NameP ILIKE? OR LastP ILKIE ?
    ORDER BY NameP';
    $params=arrar("%$value%", "%$value%");
    return Database::getRows($sql,$params);
}

public function readAll()
{
    $sql = 'SELECT IdPla, NAmeP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position
    from tbPlayer inner join tbTeams  on tbPlayer.IdTeam = tbTeams.IdTeam
    inner join tbPosition on tbPlayer.IdPos = tbPosition.IdPos
    inner join tbCountry on tbPlayer.IdCtry = tbCountry.IdCtry';
    $params = null;
    return Database::getRows($sql, $params);
}

public function readOne()
{
    $sql = 'SELECT IdPlayer, NameP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, IdTeam, IdCtry, IdUser, IdPos
    FROM tbPlayer
    WHERE IdPlayer=?';
    $params=array($this->idjugador);
    return Database::getRows($sql,$params);
}

public function updateRow($current_img)
{
    ($this-> img) ?
    $this->deleteFile($this->getImagen(),$current_img):$this->img = $current_img;

    $sql = 'UPDATE tbPlayer
            SET ImgP= ?, NameP=?, LastP=?, AgeP, AsistP=?, GoalsP= ?, MinsPlayed=?, StatusP=?, IdTeam=?, IdCtry=?, IdUSer=?, IdPos=?
            WHERE IdPlayer=?';
    $params = array($this->img, $this->nombrejugador, $this->apellidojugador, $this->edadjugador, $this->asistencias, $this-> golesmarcados, $this->minutosjugados, $this->estatus, $this->)
    return Database::executeRow($sql, $params);
}

public function deleteRow()
{
    $sql = 'DELETE FROM tbPlayer
    WHERE idPlayer = ?';
    $params = array($this->idjugador);
    return Database::executeRow($sql,$params);
}



}

?>