<?php
session_start();
// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario']) || !isset($_SESSION['correo']) || !isset($_SESSION['rol'])) {
    header('Location: index.php');
    exit();
}
?>