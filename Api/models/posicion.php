<?php

class posicion extends Validator{

    public function readAll()
{
    $sql = 'SELECT IdPos, Position from tbPosition';
    $params = null;
    return Database::getRows($sql, $params);
}
}

?>