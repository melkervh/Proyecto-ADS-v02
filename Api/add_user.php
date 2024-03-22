<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Obtener datos del formulario
$userC = $_POST['userC'];
$password = $_POST['password'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar un nuevo usuario
$sql = "INSERT INTO tbUser (UserC, Password) VALUES ('$userC', '$password')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Usuario agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>