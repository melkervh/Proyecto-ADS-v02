<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Obtener el ID del usuario a eliminar
$idUser = $_POST['idUser'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para eliminar el usuario
$sql = "DELETE FROM tbUser WHERE IdUser=$idUser";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Usuario eliminado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>