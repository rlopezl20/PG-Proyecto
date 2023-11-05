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
    <title>Registros de Recorrido</title>
    <link rel="stylesheet" href="../CSS/historial_recorridos.css">
</head>
<body>
    <header>
        <h1>Sistema de Asistencia y Movilización</h1>
    </header>
    
    <div class="container">
        <div class="menu">
        <li><a href="Menu.php">Ir a Inicio</a></li>
        </div>
        
        <div id="registro_recorrido" class="form-container">
            <main>
                <h3>Historial de Recorridos</h3>
                <table>
                    <tr>
                        <th>Código</th>
                        <th>Coordenada X</th>
                        <th>Coordenada Y</th>
                        <th>Fecha y Hora</th>
                    </tr>
                    <?php
                        // Realiza una consulta a la base de datos para obtener los registros de recorrido del usuario actual
                        $idUsuario = $usuario['ID_USUARIO'];
                        $query = "SELECT ID_USUARIO, COORDENADA_X, COORDENADA_Y, TIEMPO FROM REGISTRO_RECORRIDO WHERE ID_USUARIO = $idUsuario";
                        $result = mysqli_query($conexion, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['ID_USUARIO'] . '</td>';
                                echo '<td>' . $row['COORDENADA_X'] . '</td>';
                                echo '<td>' . $row['COORDENADA_Y'] . '</td>';
                                echo '<td>' . $row['TIEMPO'] . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No hay registros de recorrido disponibles para este usuario.</td></tr>';
                        }

                        // Cierra la conexión a la base de datos
                        mysqli_close($conexion);
                    ?>

                </table>
            </main>
        </div>
    </div>
    
    <footer>
    <p>Derechos de autor &copy; 2023 rlopez</p>
    </footer>
</body>
</html>
