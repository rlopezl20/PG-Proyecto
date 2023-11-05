<?php
// Archivo de conexión a la base de datos
include 'conexion_be.php';

// Habilita los mensajes de error de MySQL
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre del contacto a eliminar desde el formulario
    $nombreContacto = $_POST['eliminarNombre'];
    $idUsuario = $_POST['id_usuario']; // Obtén el ID_USUARIO del formulario

    // Verificar si el contacto existe antes de eliminarlo
    $consultaExiste = "SELECT COUNT(*) AS total FROM CONTACTOGPS WHERE NOMBRE = ? AND ID_USUARIO = ?";
    $stmtExiste = mysqli_prepare($conexion, $consultaExiste);

    if ($stmtExiste) {
        mysqli_stmt_bind_param($stmtExiste, "si", $nombreContacto, $idUsuario);
        mysqli_stmt_execute($stmtExiste);
        mysqli_stmt_bind_result($stmtExiste, $total);
        mysqli_stmt_fetch($stmtExiste);
        mysqli_stmt_close($stmtExiste);

        if ($total > 0) {
            // El contacto existe, procedemos a eliminarlo
            $query = "DELETE FROM CONTACTOGPS WHERE NOMBRE = ? AND ID_USUARIO = ?";
            $stmt = mysqli_prepare($conexion, $query);

            if ($stmt) {
                // Asignar valores a los parámetros
                mysqli_stmt_bind_param($stmt, "si", $nombreContacto, $idUsuario);

                // Ejecutar la sentencia de eliminación
                if (mysqli_stmt_execute($stmt)) {
                    echo '
                    <script>
                    alert("Contacto eliminado correctamente");
                    window.location = "../Paginas/contactos.php";
                    </script>
                    ';
                } else {
                    echo '
                    <script>
                    alert("Intenta nuevamente, contacto no eliminado: ' . mysqli_error($conexion) . '");
                    window.location = "../Paginas/contactos.php";
                    </script>
                    ';
                }

                // Cerrar la sentencia preparada
                mysqli_stmt_close($stmt);
            } else {
                // Manejo de errores si la sentencia preparada no se crea correctamente
                echo "Error en la sentencia preparada: " . mysqli_error($conexion);
            }
        } else {
            echo '
            <script>
            alert("El contacto no existe en la base de datos.");
            window.location = "../Paginas/contactos.php";
            </script>
            ';
        }
    } else {
        // Manejo de errores si la sentencia preparada no se crea correctamente
        echo "Error en la sentencia preparada: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
