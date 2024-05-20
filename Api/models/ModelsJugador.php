<?php
require_once('../Helpers/Base.php');
class Jugador extends Validator{

     // Declaración de atributos (propiedades).
    private $IdPla = null;
    private $NameP = null;
    private $Last = null;
    private $AgeP = null;
    private $AsistP = null;
    private $GoalsP = null;
    private $MinsP = null;
    private $ImgP = null;
    private $Status = null;
    private $IdTeam= null;
    private $IdCtry = null;
    private $IdPos=null;
    private $ruta = '../Imagenes/';
    private $IdUser = 1;

    public function setIdPla($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdPla = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdTeam($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdTeam = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdCtry($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdCtry = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdPos($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdPos = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNameP($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->NameP = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setLast($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->Last = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setAgeP($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->AgeP = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setAsistP($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->AsistP = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setGoalsP($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->GoalsP = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setMinsP($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->MinsP = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setStatus($value)
    {
        if ($this->validateBoolean($value, 1, 50)) {
            $this->Status = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setImgP($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->ImgP= $this->getFileName();
            return true;
        } else {
            return false;
        }
    }
    public function getRuta()
    {
        return $this->ruta;
    }
    public function getImgP()
    {
        return $this->ImgP;
    }
  // gets 
  public function getIdPla()
  {
      return $this->IdPla;
  }
  public function getIdTeam()
  {
      return $this->IdTeam;
  }
  public function getIdCtry ()
  {
      return $this->IdCtry ;
  }
  public function getIdPos ()
  {
      return $this->IdPos ;
  }
  public function getNameP ()
  {
      return $this->NameP ;
  }
  public function getLast ()
  {
      return $this->Last ;
  }
  public function getAgeP()
  {
      return $this->AgeP ;
  }
  public function getAsistP()
  {
      return $this->AsistP ;
  }
  public function getGoalsP()
  {
      return $this->GoalsP ;
  }
  public function getMinsP()
  {
      return $this->MinsP ;
  }
  public function getStatus()
  {
      return $this->Status ;
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

<<<<<<< Updated upstream
=======
    public function reporteJugador()
    {
        $sql = 'SELECT IdPla, NAmeP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position
        FROM rbplayer 
        ORDER BY NAmeP';
        $params = null;
        return Database::getRows($sql,$params);
    }

    public function checkJugador($alias)
    {
        $sql = 'SELECT id_Pla FROM tbPlayer WHERE idPla = ?';
        $params = array($alias);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_Pla'];
            $this->alias = $alias;
            return true;
        } else {
            return false;
        }
    }
    public function createRow()
    {
        $sql = 'INSERT INTO tbPlayer(NAmeP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position )
                VALUES(?, ?, ?, ?, ?,?,'', 0,?,?,?'; 
        $params = array($this->nombres, $this->apellidos, $this->edad, $this->asistencias, $this->goles, $this->minutosJugados,$this->img,$this->estado,$this->equipo,$this->pais,$this->posicion);
        return Database::executeRow($sql, $params);
    }
    public function updateRow()
    {
        $sql = 'UPDATE tbPlayer 
                SET NAmeP = ?, LastP = ?, AgeP = ?, AsistP = ?, GoalsP = ?, MinsPlayed = ?, ImgP = ?, StatusP = 0, tbTeams.TeamName = ?, tbCountry.CtryName = ?, tbPosition.Position = ?
                WHERE idPla = ?';
        $params = array($this->nombres, $this->apellidos, $this->edad, $this->asistencias, $this->goles, $this->minutosJugados,$this->img,$this->estado,$this->equipo,$this->pais,$this->posicion);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tbPlayer
                WHERE idPla = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
>>>>>>> Stashed changes
}

?>