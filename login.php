<?php
// Incluye el archivo de conexión
include 'conexion_be.php';

try {
    // Verifica si se han recibido datos del formulario
    if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        // Escapa los valores para evitar inyección de SQL
        $correo = mysqli_real_escape_string($conexion, $correo);
        $contrasena = mysqli_real_escape_string($conexion, $contrasena);

        $query = "SELECT * FROM USUARIO WHERE CORREO_ELECTRONICO='$correo' AND CONTRASENA='$contrasena'";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $usuario = mysqli_fetch_assoc($result); // Obtiene la fila del usuario

                // Inicia la sesión si no está iniciada
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Almacena la información del usuario en una variable de sesión
                $_SESSION['usuario'] = $usuario;

                $_SESSION['idUsuario'] = $usuario['ID_USUARIO']; // Asigna el ID de usuario a la sesión

                // Simula una respuesta JSON para enviar al JavaScript
                $response = [
                    'success' => true
                ];
                echo json_encode($response);
                exit;
            }
        }
    }

    // Si no se cumple ninguna condición anterior, responde con un error
    $response = [
        'success' => false
    ];
    echo json_encode($response);
    exit;
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>
