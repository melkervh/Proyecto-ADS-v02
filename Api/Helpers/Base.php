<?php
class Database
{
    private static $connection = null;
    private static $statement = null;
    private static $error = null;

    /*
    *   Método para establecer la conexión con el servidor de base de datos.
    */
    private static function connect()
    {
        // Credenciales para establecer la conexión con la base de datos.
        $server = 'localhost';
        $database = 'Ads';
        $username = 'sa';  
        $password = '1234';  

        // Se crea la conexión mediante la extensión PDO y el controlador para SQL Server.
        try {
            self::$connection = new PDO("sqlsrv:server=$server;Database=$database", $username, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            self::setException($error->getCode(), $error->getMessage());
            die(self::getException());
        }
    }

    /*
    *   Método para ejecutar las siguientes sentencias SQL: insert, update y delete.
    */
    public static function executeRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            $state = self::$statement->execute($values);
            self::$connection = null;  // Se anula la conexión con el servidor de base de datos.
            return $state;
        } catch (PDOException $error) {
            self::setException($error->getCode(), $error->getMessage());
            return false;
        }
    }

    /*
    *   Método para obtener el valor de la llave primaria del último registro insertado.
    */
    public static function getLastRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            if (self::$statement->execute($values)) {
                $id = self::$connection->lastInsertId();
            } else {
                $id = 0;
            }
            self::$connection = null;  // Se anula la conexión con el servidor de base de datos.
            return $id;
        } catch (PDOException $error) {
            self::setException($error->getCode(), $error->getMessage());
            return 0;
        }
    }

    /*
    *   Método para obtener un registro de una sentencia SQL tipo SELECT.
    */
    public static function getRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            $row = self::$statement->fetch(PDO::FETCH_ASSOC);
            self::$connection = null;  // Se anula la conexión con el servidor de base de datos.
            return $row;
        } catch (PDOException $error) {
            self::setException($error->getCode(), $error->getMessage());
            die(self::getException());
        }
    }

    /*
    *   Método para obtener todos los registros de una sentencia SQL tipo SELECT.
    */
    public static function getRows($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            $rows = self::$statement->fetchAll(PDO::FETCH_ASSOC);
            self::$connection = null;  // Se anula la conexión con el servidor de base de datos.
            return $rows;
        } catch (PDOException $error) {
            self::setException($error->getCode(), $error->getMessage());
            die(self::getException());
        }
    }

    /*
    *   Método para establecer un mensaje de error personalizado al ocurrir una excepción.
    */
    private static function setException($code, $message)
    {
        self::$error = "Error Code: $code - $message";
    
        switch ($code) {
            case '08001':
                self::$error .= ' - Existe un problema al conectar con el servidor';
                break;
            case '42S22':
                self::$error .= ' - Nombre de campo desconocido';
                break;
            case '23000':
                self::$error .= ' - Dato duplicado, no se puede guardar';
                break;
            case '42S02':
                self::$error .= ' - Nombre de tabla desconocido';
                break;
            case '42000':
                self::$error .= ' - Registro ocupado, no se puede eliminar';
                break;
            default:
                self::$error .= ' - Ocurrió un problema en la base de datos';
        }
      
        // Registrar el error en un archivo de registro
        error_log(self::$error, 3, 'errors.log');
        echo self::$error; 
    }

    public static function getException()
    {
        return self::$error;
    }
}
?>
