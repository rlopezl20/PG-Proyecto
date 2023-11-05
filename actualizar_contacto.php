<?php
session_start();
// Incluye la conexión a la base de datos
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombreActualizar = $_POST['actualizarNombre'];
    $nuevoCorreo = $_POST['nuevoCorreo']; // Cambio aquí
    $idUsuarioAutenticado = $_SESSION['usuario']['ID_USUARIO'];

    // Verifica si el contacto existe antes de la actualización
    $queryVerificar = "SELECT 1 FROM CONTACTOGPS WHERE ID_USUARIO = ? AND NOMBRE = ?";
    $stmtVerificar = mysqli_prepare($conexion, $queryVerificar);

    if ($stmtVerificar) {
        mysqli_stmt_bind_param($stmtVerificar, 'is', $idUsuarioAutenticado, $nombreActualizar);
        mysqli_stmt_execute($stmtVerificar);
        $resultado = mysqli_stmt_get_result($stmtVerificar);

        if (mysqli_num_rows($resultado) > 0) {
            // El contacto existe, procede con la actualización
            $query = "UPDATE CONTACTOGPS SET CORREO = ? WHERE ID_USUARIO = ? AND NOMBRE = ?";
            $stmt = mysqli_prepare($conexion, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sis', $nuevoCorreo, $idUsuarioAutenticado, $nombreActualizar); // Cambio aquí
                if (mysqli_stmt_execute($stmt)) {
                    // Redirige a la página de contactos
                    header("Location: ../Paginas/contactos.php");
                    exit;
                } else {
                    // Manejo de errores si la actualización falla
                    echo "Error al actualizar el contacto: " . mysqli_error($conexion);
                }

                mysqli_stmt_close($stmt);
            } else {
                // Manejo de errores si la sentencia preparada no se crea correctamente
                echo "Error en la sentencia preparada: " . mysqli_error($conexion);
            }
        } else {
            // El contacto no existe, muestra un mensaje de error
            echo "El contacto no existe.";
        }

        mysqli_stmt_close($stmtVerificar);
    } else {
        // Manejo de errores si la sentencia preparada de verificación no se crea correctamente
        echo "Error en la sentencia preparada de verificación: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}

?>
