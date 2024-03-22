<?php
$serverName = "tu_servidor";
$connectionInfo = array("Database"=>"Ads", "UID"=>"tu_usuario", "PWD"=>"tu_contrasena");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?> 