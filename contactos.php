<?php
// quitar todo este php si no funciona
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
    <title>Contactos</title>
    <link rel="stylesheet" href="../CSS/contactos.css">
</head>
<body>
    <header>
        <h1>Sistema de Asistencia y Movilización</h1>
    </header>
    
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="#contactos">Contactos</a></li>
                <li><a href="#agregar">Agregar</a></li>
                <li><a href="#eliminar">Eliminar</a></li>
                <li><a href="#actualizar">Actualizar</a></li>
                <li><a href="Menu.php">Ir a Inicio</a></li>
            </ul>
        </div>
        <!-- prueba -->
        <div id="contactos" class="form-container">
            <main>
                <!-- Agregar la tabla de contactos -->
                <h3>Tus Contactos</h3>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Fecha de Registro</th>
                    </tr>
                    <?php
                    // Realiza una consulta a la base de datos para obtener los contactos
                    $idUsuario = $usuario['ID_USUARIO'];
                    $query = "SELECT NOMBRE, CORREO, FECHA_REGISTRO FROM CONTACTOGPS WHERE ID_USUARIO = $idUsuario";
                    $result = mysqli_query($conexion, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['NOMBRE'] . '</td>';
                            echo '<td>' . $row['CORREO'] . '</td>';
                            echo '<td>' . $row['FECHA_REGISTRO'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">No tienes contactos registrados.</td></tr>';
                    }

                    // Cierra la conexión a la base de datos
                    mysqli_close($conexion);
                    ?>
                </table>
          </main>
        </div>

        <!-- formulario de agregar -->
        <div id="agregar" class="form-container">
            <h2>Ingresa los Datos de tu Contacto</h2>
            <form action="../PHP/registrar_contactos.php" method="POST">
                <!-- <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $idUsuario; ?>"> -->
                <div class="form-group">
                    <label for="id_usuario">Este es tu Código de Usuario:</label>
                    <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $usuario['ID_USUARIO']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre_contacto">Ingresar el nombre del Contacto:</label>
                    <input type="text" id="nombre_contacto" name="nombre_contacto" required>
                </div>
                <div class="form-group">
                    <label for="correo">Ingresa el Correo del Usuario:</label>
                    <input type="text" id="correo" name="correo" required>
                </div>
                    <input type="submit" value="Agregar" class="btn">
            </form>
        </div>

        <!-- formulario de eliminar -->
        <div id="eliminar" class="form-container">
            <h2>Eliminar Contacto</h2>
            <form action="../PHP/eliminar_contacto.php" method="POST">
                <p>Tu Código: <?php echo $usuario['ID_USUARIO']; ?></p>
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['ID_USUARIO']; ?>">
                <label for="eliminarNombre">Nombre a Eliminar:</label>
                <input type="text" id="eliminarNombre" name="eliminarNombre" required><br><br>
                <input type="submit" value="Eliminar" class="btn">
            </form>
        </div>


          <!-- Formulario de Actualización de Contacto -->
        <div id="actualizar" class="form-container">
            <h2>Actualizar Contacto</h2>
            <form action="../PHP/actualizar_contacto.php" method="POST">
                <input type="hidden" name="id_usuario" value="<?php echo $usuario['ID_USUARIO']; ?>">
                <label for="actualizarNombre">Nombre a Actualizar:</label>
                <input type="text" id="actualizarNombre" name="actualizarNombre" required><br><br>
                <label for="nuevoCorreo">Nuevo Correo:</label> <!-- Cambio aquí -->
                <input type="text" id="nuevoCorreo" name="nuevoCorreo" required><br><br> <!-- Cambio aquí -->
                <input type="submit" value="Actualizar" class="btn">
            </form>
        </div>


    </div>

    <footer>
        <p>Derechos de autor &copy; 2023 rlopez</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contactosLink = document.querySelector('a[href="#contactos"]');
            const agregarLink = document.querySelector('a[href="#agregar"]');
            const eliminarLink = document.querySelector('a[href="#eliminar"]');
            const actualizarLink = document.querySelector('a[href="#actualizar"]');
            
            const contactosForm = document.getElementById('contactos');
            const agregarForm = document.getElementById('agregar');
            const eliminarForm = document.getElementById('eliminar');
            const actualizarForm = document.getElementById('actualizar');
    
            // Inicialmente, oculta todos los formularios excepto el de agregar
            contactosForm.style.display = 'block';
            agregarForm.style.display = 'none';
            eliminarForm.style.display = 'none';
            actualizarForm.style.display = 'none';
    
            contactosLink.addEventListener('click', function (event) {
                event.preventDefault();
                contactosForm.style.display = 'block';
                agregarForm.style.display = 'none';
                eliminarForm.style.display = 'none';
                actualizarForm.style.display = 'none';
            });

            agregarLink.addEventListener('click', function (event) {
                event.preventDefault();
                contactosForm.style.display = 'none';
                agregarForm.style.display = 'block';
                eliminarForm.style.display = 'none';
                actualizarForm.style.display = 'none';
            });
    
            eliminarLink.addEventListener('click', function (event) {
                event.preventDefault();
                contactosForm.style.display = 'none';
                agregarForm.style.display = 'none';
                eliminarForm.style.display = 'block';
                actualizarForm.style.display = 'none';
            });
    
            actualizarLink.addEventListener('click', function (event) {
                event.preventDefault();
                contactosForm.style.display = 'none';
                agregarForm.style.display = 'none';
                eliminarForm.style.display = 'none';
                actualizarForm.style.display = 'block';
            });
        });
    </script>
    
</body>
</html>