<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
        <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
        <input type="password" name="contraseña" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes cuenta? <a href="registro.html">Regístrate aquí</a></p>
</body>
</html>
<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tienda_carteras";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contraseña = $_POST["contraseña"];

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contraseña, $usuario["contraseña"])) {
            // Iniciar sesión
            $_SESSION["usuario"] = $usuario["nombre_usuario"];
            header("Location: index.html"); // Redirigir a la página principal
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }
}

$conn->close();
?>

