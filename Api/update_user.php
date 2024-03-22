<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Obtener datos del formulario
$idUser = $_POST['idUser'];
$newUserC = $_POST['newUserC'];
$newPassword = $_POST['newPassword'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para actualizar el usuario
$sql = "UPDATE tbUser SET UserC='$newUserC', Password='$newPassword' WHERE IdUser=$idUser";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>