<?php
// Iniciar sesión
session_start();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar las credenciales
    $usuario = "Admin@gmail.com";
    $contraseña = "1234";

    if ($_POST["usuario"] == $usuario && $_POST["contraseña"] == $contraseña) {
        // Credenciales correctas, iniciar sesión y redirigir al usuario a home.php
        $_SESSION["usuario"] = $usuario;
        header("location: home.php");
        exit;
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>