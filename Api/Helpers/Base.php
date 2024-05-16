<?php
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "Ads",
    "Uid" => "sa",
    "PWD" => "Daz04"
);

// Intenta conectar
$conn = new PDO("sqlsrv:server=$serverName;Database={$connectionOptions['Database']}", $connectionOptions['Uid'], $connectionOptions['PWD']);

// Chequea si la conexión fue exitosa
if ($conn) {
    echo "Conexión exitosa";
} else {
    echo "Error de conexión: " . print_r(sqlsrv_errors(), true);
}
// Intenta conectar
$conn = sqlsrv_connect($serverName, $connectionOptions);
?>

