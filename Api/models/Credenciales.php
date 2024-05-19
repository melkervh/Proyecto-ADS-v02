<?php
require_once('../Helpers/Base.php');
Class Credenciales extends Validator
{
    public function readAll()
    {
        $sql = 'SELECT IdUser , UserC FROM tbUser';
            $params = null;
            return Database::getRows($sql, $params);
    }
}
?>