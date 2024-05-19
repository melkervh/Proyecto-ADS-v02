<?php
class equipo extends Validator{

    public function readAll()
{
    $sql = 'SELECT IdTeam, TeamName from tbTeams';
    $params = null;
    return Database::getRows($sql, $params);
}
}


?>