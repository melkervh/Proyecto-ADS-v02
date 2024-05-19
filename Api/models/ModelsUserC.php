<?php
require_once('../Helpers/Base.php');
Class Usuario2 extends Validator
{
     // Declaración de atributos (propiedades).
     private $idvoters = null;
     private $IdUser= null;
     private $DuiUser = null;
     private $nombre_voters = null;
     private $apellido_voters= null;
     private $genero = null;
     private $clave_voters= null;
     private $correo_voters = null;
 
     /*
    *   Métodos para validar y asignar valores de los atributos.
    */

    public function setIdvoters($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idvoters = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIduser($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdUser = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombrevoters($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre_voters = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setDuiUser($value)
    {
        if ($this->validateDUI($value, 1, 9)) {
            $this->DuiUser = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setApellidovoters($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido_voters = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setgenero($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClavevoters($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave_voters =($value);
            return true;
        } else {
            return false;
        }
    }

    public function setCorreovoters($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo_voters = $value;
            return true;
        } else {
            return false;
        }
    }

     /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getIdvoters()
    {
        return $this->idvoters;
    }
    public function getIduser()
    {
        return $this->IdUser;
    }

    public function getNombrevoters()
    {
        return $this->nombre_voters;
    }

    public function getApellidovoters()
    {
        return $this->apellido_voters;
    }
    public function getDuiUser()
    {
        return $this->DuiUser;
    }
    public function getClavevoters()
    {
        return $this->clave_voters;
    }

    public function getCorreoVoters()
    {
        return $this->correo_voters;
    }

public function readAll()
    {
        $sql = 'SELECT 
        tbVoters.IdVot, tbVoters.NameV, tbVoters.LastV, tbVoters.DuiV, 
        tbGender.Gender,tbUser.UserC
        FROM 
            tbVoters
        INNER JOIN 
            tbUser ON tbVoters.IdUser = tbUser.IdUser
        INNER JOIN 
            tbGender ON tbVoters.IdGen = tbGender.IdGen;';
            $params = null;
            return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT 
        tbVoters.IdVot, tbVoters.NameV, tbVoters.LastV, tbVoters.DuiV, 
        tbGender.Gender,tbUser.UserC, tbUser.Passwordc
        FROM 
            tbVoters
        INNER JOIN 
            tbUser ON tbVoters.IdUser = tbUser.IdUser
        INNER JOIN 
            tbGender ON tbVoters.IdGen = tbGender.IdGen;
         WHERE tbVoters.IdVot = ?';
        $params = array($this->idvoters);
        return Database::getRow($sql, $params);
    }
    public function createRow(){
        $sql = 'INSERT INTO tbVoters(NameV,LastV,DuiV,IdGen,IdUser)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_voters, $this->apellido_voters, $this->DuiUser, $this->genero, $this->IdUser);
        return Database::executeRow($sql, $params);
    }
    public function createRow2(){
        $sql = 'INSERT INTO tbUser(UserC, Passwordc) VALUES(?, ?)';
        $params = array($this->setCorreovoters, $this->setClavevoters);
        return Database::executeRow($sql, $params);
    }
}
?>