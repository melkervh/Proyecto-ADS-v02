<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    // Redirigir al usuario al formulario de inicio de sesión
    header("location: login.php");
    exit;
}

// Verificar el tipo de usuario (admin o cliente)
$tipoUsuario = "Admin"; 
?>
