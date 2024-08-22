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

// Procesar la compra
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto_id"];
    $cantidad = $_POST["cantidad"];

    // Guardar la compra en la base de datos
    $sql = "INSERT INTO ventas (producto_id, cantidad) VALUES ('$producto_id', '$cantidad')";

    if ($conn->query($sql) === TRUE) {
        echo "Compra realizada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
