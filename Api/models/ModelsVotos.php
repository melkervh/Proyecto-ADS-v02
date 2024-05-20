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
<<<<<<< Updated upstream
                public function vote($idPla, $idVot)
            {
                // Verificar si el usuario ya ha votado por este jugador
                if ($this->checkVoteExists($idPla, $idVot)) {
                    return false; // Indica que el usuario ya ha votado anteriormente
                }

                // Obtener la fecha actual en el formato deseado (año-mes-día)
                $currentDate = date('Y-m-d');

                // Insertar el voto en la tabla tbVotos
                try {
                    $sql = 'INSERT INTO tbVotos (IdPla, IdVot, DateVot) VALUES (?, ?, ?)';
                    $params = array($idPla, $idVot, $currentDate);
                    Database::executeRow($sql, $params);
                    return true; // Indica que el voto se ha registrado correctamente
                } catch (Exception $e) {
                    return false; // Indica que ha ocurrido un error al registrar el voto
                }
            }

        private function checkVoteExists($idPla, $idVot)
        {
            try {
                $sql = 'SELECT COUNT(*) as total FROM tbVotos WHERE IdPla = ? AND IdVot = ?';
                $params = array($idPla, $idVot);
                $result = Database::getRow($sql, $params);
    
                // Verificar si se encontró algún registro
                if ($result && isset($result['total'])) {
                    return $result['total'] > 0;
                } else {
                    // Si no se encontró ningún registro, retornar falso
                    return false;
                }
            } catch (Exception $e) {
                // Capturar cualquier excepción y retornar falso
                return false;
            }
        }    
    
=======

    public function reporteResultados()
    {
        $sql = 'SELECT NAmeP, LastP, AgeP, GoalsP, StatusP ,tbTeams.TeamName, tbCountry.CtryName, tbPosition.Position
        FROM tbplayer 
        ORDER BY StatusP';
        $params = null;
        return Database::getRows($sql,$params);
    }
>>>>>>> Stashed changes
}


?>