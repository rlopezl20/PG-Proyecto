<?php
session_start(); // Inicia la sesión si aún no se ha iniciado

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    $response = ['idUsuario' => $idUsuario];
} else {
    $response = ['idUsuario' => null];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
