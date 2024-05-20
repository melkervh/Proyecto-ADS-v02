<?php
require_once('../Helpers/Base.php');
Class Usuario extends Validator
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

    /*
    *   Métodos para gestionar la cuenta del usuario.
    */

    public function validarconexion()
    {
        $sql = 'SELECT IdUser, UserC
        FROM tbUser ORDER BY IdUser';
        $params = null;
        return Database::getRow($sql, $params);
    }

    public function checkCredentials($correo_voters, $password)
{
    $sql = 'SELECT IdUser, Passwordc FROM tbUser WHERE UserC = ?';
    $params = array($correo_voters);
    $userData = Database::getRow($sql, $params);
    
    if ($userData) {
        // Obtenemos la contraseña almacenada en texto plano
        $storedPassword = $userData['Passwordc'];
        
        // Verificamos si la contraseña proporcionada coincide con la almacenada
        if ($password === $storedPassword) {
            // Si la contraseña coincide, establecemos el ID de usuario en la sesión
            $_SESSION['IdUser'] = $userData['IdUser'];
            return true; // Credenciales válidas
        } else {
            return false; // Contraseña incorrecta
        }
    } else {
        return false; // El usuario no fue encontrado en la base de datos
    }
}

public function checkCredentials2($DuiUser, $password)
{
    $sql = 'SELECT DuiV, IdVot, tbUser.Passwordc
    FROM tbVoters
    INNER JOIN tbUser ON tbVoters.IdUser = tbUser.IdUser
    WHERE DuiV = ?';
    $params = array($DuiUser);
    $userData = Database::getRow($sql, $params);
    
    if ($userData) {
        // Obtenemos la contraseña almacenada en texto plano
        $storedPassword = $userData['Passwordc'];
        
        // Verificamos si la contraseña proporcionada coincide con la almacenada
        if ($password === $storedPassword) {
            // Si la contraseña coincide, establecemos el ID de usuario en la sesión
            $_SESSION['IdVot'] = $userData['IdVot'];
            return true; // Credenciales válidas
        } else {
            return false; // Contraseña incorrecta
        }
    } else {
        return false; // El usuario no fue encontrado en la base de datos
    }
}
public function reporteUsuarios()
     {
         $sql = 'SELECT nombre_voters, apellidos_voters, DuiUser,
                 FROM usuarios 
                 ORDER BY apellidos_usuario';
         $params = null;
         return Database::getRows($sql,$params);
     }

}
?>