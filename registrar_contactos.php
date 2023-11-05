<?php
// Archivo de conexión a la base de datos
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombreContacto = $_POST['nombre_contacto'];
    $correo = $_POST['correo'];
    $idUsuario = $_POST['id_usuario'];

    // Crear una sentencia preparada para insertar el contacto en la base de datos
    $query = "INSERT INTO CONTACTOGPS (ID_USUARIO, NOMBRE, CORREO, FECHA_REGISTRO) VALUES (?, ?, ?, NOW())";

    $stmt = mysqli_prepare($conexion, $query);

    if ($stmt) {
        // Asignar valores a los parámetros
        mysqli_stmt_bind_param($stmt, "iss", $idUsuario, $nombreContacto, $correo);

        // Ejecutar la sentencia
        if (mysqli_stmt_execute($stmt)) {
            echo '
            <script>
            alert("Contacto almacenado correctamente");
            window.location = "../Paginas/contactos.php";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Intenta nuevamente, contacto no almacenado: ' . mysqli_error($conexion) . '");
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

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
