
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
</head>
<body>
    <header>
        <h1>Sistema de Asistencia y Movilización</h1>
    </header>
    
    
    <nav>
        <button class="menu-toggle">☰</button>
        <ul class="menu-list">
            <li><a href="#">Inicio</a></li>
            <li><a href="#" id="perfil-usuario">Perfil</a></li>
            <li><a href="#" id="contacto-usuario">Contactos</a></li>
            <li><a href="#" id="historial-recorridos">Historial de Recorridos</a></li>
            <li><a href="#">Configuración</a></li>
            <li><a href="#" id="cerrar-sesion">Cerrar Sesión</a></li>
        </ul>
    </nav>
    
    <main>
        <h2>Bienvenid@, <?php echo $usuario['NOMBRE']; ?></h2>
        <p>Este es el menú principal del sistema.</p>
    </main>

    <footer>
        <p>Derechos de autor &copy; 2023 rlopez</p>
    </footer>
    <script>
    // Esperar a que el documento HTML se cargue completamente
    document.addEventListener('DOMContentLoaded', function () {
    // Agregar un evento de clic al enlace "Cerrar Sesión"
    const cerrarSesionLink = document.getElementById('cerrar-sesion');
    cerrarSesionLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        window.location.href = '../Paginas/login.html'; // Redirige al usuario al inicio de sesión
    });
    });
    </script>
    <script>
    // Esperar a que el documento HTML se cargue completamente
    document.addEventListener('DOMContentLoaded', function () {
    // Agregar un evento de clic al enlace de perfil
    const perfilLink = document.getElementById('perfil-usuario');
    perfilLink.addEventListener('click', function (event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace (evita que cambie la página)
        // Redirige al usuario a la página de perfil.html
        window.location.href = '../Paginas/perfil.php';
    });
    });
    </script>
    <script>
    // Espera a que el documento HTML se cargue completamente
    document.addEventListener('DOMContentLoaded', function () {

    // ... Tu código existente ...

    // Agrega un evento de clic al enlace "Cerrar Sesión"
    const cerrarSesionLink = document.getElementById('contacto-usuario');
    cerrarSesionLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        window.location.href = '../Paginas/contactos.php'; // Redirige al usuario al inicio de sesión
     });
    });
    </script>
    <script>
    // Espera a que el documento HTML se cargue completamente
    document.addEventListener('DOMContentLoaded', function () {
    // ... Tu código existente ...
    // Agrega un evento de clic al enlace "Cerrar Sesión"
    const cerrarSesionLink = document.getElementById('historial-recorridos');
    cerrarSesionLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        window.location.href = '../Paginas/historial_recorridos.php'; // Redirige al usuario al inicio de sesión
     });
    });
    </script>
<script src="../JS/menu.js"></script>
<script src="../JS/websocket.js"></script>
</body>
</html>
