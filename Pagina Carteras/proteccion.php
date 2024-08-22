<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// Código de la página para usuarios autenticados
echo "Bienvenido, " . $_SESSION["usuario"];
?>
<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
?>
