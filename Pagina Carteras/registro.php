<?php
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
    $email = $_POST["email"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT); // Hashear la contraseña para seguridad

    // Verificar si el nombre de usuario o email ya existen
    $verificar_usuario = $conn->query("SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario' OR email='$email'");
    
    if ($verificar_usuario->num_rows > 0) {
        echo "El nombre de usuario o email ya están en uso.";
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (nombre_usuario, email, contraseña) VALUES ('$nombre_usuario', '$email', '$contraseña')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso. <a href='login.html'>Inicia sesión aquí</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
