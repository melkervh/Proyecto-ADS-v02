<?php

class pais extends Validator{

    public function readAll()
{
    $sql = 'SELECT IdCtry, CtryName from tbCountry';
    $params = null;
    return Database::getRows($sql, $params);
}
}

?>