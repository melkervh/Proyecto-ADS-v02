<?php
require_once('../Helpers/Base.php');
Class Genero extends Validator
{
    public function readAll()
    {
        $sql = 'SELECT  IdGen,Gender FROM tbGender';
            $params = null;
            return Database::getRows($sql, $params);
    }
}
?>