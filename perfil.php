<?php
// Incluye el archivo de conexión
include '../PHP/conexion_be.php';

try {
    // Verifica si la sesión está iniciada y si existe la variable de sesión 'usuario'
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.html");
        exit;
    }
    $usuario = $_SESSION['usuario'];
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encabezado y enlaces a hojas de estilo y scripts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../CSS/perfil.css"> <!-- Enlaza tu archivo CSS aquí -->

</head>
<body>
<header>
       <h1>Sistema de Asistencia y Movilización</h1>
   </header>
   <main>
    <div class="container">
        <h2>Perfil de Usuario</h2>
        <div class="perfil-info">
            <p>Código: <?php echo $usuario['ID_USUARIO']; ?></p>
            <p>Nombre: <?php echo $usuario['NOMBRE']; ?> <?php echo $usuario['APELLIDO']; ?></p>
            <p>Teléfono: <?php echo $usuario['TELEFONO']; ?></p>
            <p>Correo: <?php echo $usuario['CORREO_ELECTRONICO']; ?></p>
            <!-- Mostrar más información del usuario si es necesario -->
        </div>
        <!-- Botón para cerrar sesión -->
        <div class="btn-container">
            <a href="Menu.php" class="btn btn-cancel">Inicio</a>
        </div>
    </div>
    </main>
    <footer>
        <p>Derechos de autor &copy; 2023 rlopez</p>
    </footer>
    <!-- Scripts -->
</body>
</html>