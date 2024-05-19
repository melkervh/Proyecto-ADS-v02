<?php

class Votos extends Validator{

    public function ReadJugador()
    {
        $sql = 'SELECT IdPla, NAmeP, LastP, AgeP, AsistP, GoalsP, MinsPlayed, ImgP, StatusP, tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position
        from tbPlayer inner join tbTeams  on tbPlayer.IdTeam = tbTeams.IdTeam
        inner join tbPosition on tbPlayer.IdPos = tbPosition.IdPos
        inner join tbCountry on tbPlayer.IdCtry = tbCountry.IdCtry';
        $params = null;
        return Database::getRows($sql, $params);
    }
}


?>