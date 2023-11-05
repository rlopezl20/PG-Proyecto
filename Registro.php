<?php
include 'conexion_be.php';
//BORRARLO SI NO FUNCIONA
$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$genero = $_POST['genero'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$departamento_nombre = $_POST['departamento'];
$municipio_nombre = $_POST['municipio'];
//encriptar contraseñas
//$contrasena = hash('sha512', $contrasena);

// Realizar consultas para obtener los IDs correspondientes a los nombres de departamento y municipio
$query_departamento = "SELECT ID_DEPARTAMENTO FROM DEPARTAMENTO WHERE NOMBRE = '$departamento_nombre'";
$query_municipio = "SELECT ID_MUNICIPIO FROM MUNICIPIO WHERE NOMBRE= '$municipio_nombre'";

$resultado_departamento = mysqli_query($conexion, $query_departamento);
$resultado_municipio = mysqli_query($conexion, $query_municipio);

if ($resultado_departamento && $resultado_municipio && mysqli_num_rows($resultado_departamento) > 0 && mysqli_num_rows($resultado_municipio) > 0) {
    // Procede a obtener los valores de los arrays de resultados
    $fila_departamento = mysqli_fetch_assoc($resultado_departamento);
    $fila_municipio = mysqli_fetch_assoc($resultado_municipio);
    
    $id_departamento = $fila_departamento['ID_DEPARTAMENTO'];
    $id_municipio = $fila_municipio['ID_MUNICIPIO'];

    // Crea una sentencia preparada
    // BORRAR ID SI NO FUNCIONA
    $query = "INSERT INTO USUARIO (ID_USUARIO, NOMBRE, APELLIDO, GENERO, TELEFONO, CORREO_ELECTRONICO, CONTRASENA, FECHA_REGISTRO, ID_DEPARTAMENTO, ID_MUNICIPIO)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
    
    $stmt = mysqli_prepare($conexion, $query);
    
    if ($stmt) {
        // QUITAR CAMBIOS SI NO FUNCIONA
        // Asigna valores a los parámetros
        //mysqli_stmt_bind_param($stmt, "ssssssii", $nombre, $apellido, $genero, $telefono, $correo, $contrasena, $id_departamento, $id_municipio);
        mysqli_stmt_bind_param($stmt, "isssssiii", $id_usuario, $nombre, $apellido, $genero, $telefono, $correo, $contrasena, $id_departamento, $id_municipio);
        
        // verificar si existe correo electronico
        $verificar_id = mysqli_query($conexion, "SELECT * FROM USUARIO WHERE ID_USUARIO='$id_usuario' ");
        if(mysqli_num_rows($verificar_id) > 0){
            echo '
            <script>
            alert("El id ya esta en uso, intenta con otro diferente");
            window.location = "../Paginas/Registro.html";
            </script>
            ';
            exit();
        }
        // verificar si existe correo electronico
            $verificar_correo = mysqli_query($conexion, "SELECT * FROM USUARIO WHERE CORREO_ELECTRONICO='$correo' ");
            if(mysqli_num_rows($verificar_correo) > 0){
                echo '
                <script>
                alert("El correo ya esta en uso, intenta con otro diferente");
                window.location = "../Paginas/Registro.html";
                </script>
                ';
                exit();
            }


        // Ejecuta la sentencia
        if (mysqli_stmt_execute($stmt)) {
            echo '
            <script>
            alert("Usuario almacenado correctamente");
            window.location = "../Paginas/login.html";
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Intenta nuevamente, usuario no almacenado");
            window.location = "../Paginas/login.html";
            </script>
            ';
        }
        
        // Cierra la sentencia preparada
        mysqli_stmt_close($stmt);
    } else {
        // Manejo de errores si la sentencia preparada no se crea correctamente
        echo "Error en la sentencia preparada: " . mysqli_error($conexion);
    }
} else {
    if (!$resultado_departamento) {
        echo "Error en la consulta departamento: " . mysqli_error($conexion);
    }
    
    if (!$resultado_municipio) {
        echo "Error en la consulta municipio: " . mysqli_error($conexion);
    }
}
mysqli_close($conexion);
?>



