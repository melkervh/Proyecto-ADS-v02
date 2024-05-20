<?php
require_once('../Helpers/Base.php');
Class Graficos extends Validator
{
    public function graficoTopsjugadores()
{
    $sql = 'SELECT TOP 10 COUNT(IdVote) AS "Cantidad", P.NameP AS "Jugador"
    FROM tbVotos AS V
    INNER JOIN tbPlayer AS P ON (V.IdPla = P.IdPla)
    GROUP BY P.NameP
    ORDER BY Cantidad DESC';
    $params = null;
    return Database::getRows($sql, $params);
}
public function ReadAll()
{
    $sql = 'SELECT TOP 3 P.IdPla, P.NameP AS "Jugador_Nombre", P.LastP AS "Jugador_Apellido", COUNT(V.IdVote) AS "CantidadVotos", 
    P.AgeP, P.AsistP, P.GoalsP, P.MinsPlayed, P.ImgP, P.StatusP, T.TeamName, C.CtryName, Pos.Position
    FROM tbVotos AS V
    INNER JOIN tbPlayer AS P ON (V.IdPla = P.IdPla)
    INNER JOIN tbTeams AS T ON (P.IdTeam = T.IdTeam) -- Join with tbTeams table
    INNER JOIN tbCountry AS C ON (P.IdCtry = C.IdCtry) -- Join with tbCountry table
    INNER JOIN tbPosition AS Pos ON (P.IdPos = Pos.IdPos) -- Join with tbPosition table
    GROUP BY P.IdPla, P.NameP, P.LastP, P.AgeP, P.AsistP, P.GoalsP, P.MinsPlayed, P.ImgP, P.StatusP, T.TeamName, C.CtryName, Pos.Position
    ORDER BY CantidadVotos DESC; ';
    $params = null;
    return Database::getRows($sql, $params);
}
}
?>