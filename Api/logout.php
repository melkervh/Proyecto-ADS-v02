<?php
// Iniciar sesión
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario al formulario de inicio de sesión
header("location: login.php");
exit;
?>