<?php
//FUNCIONES PARA EL MANEJO DE LA BASE DE DATOS SPOTLIFE

// Conexión a la base de datos SPOTLIFE
include_once 'conexionBD.php';

// Función para mostrar el listado de tipos de sangre
function listadoTiposSangre()
{
    global $conn;
    $sql = "SELECT * FROM tipos_sangre;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    //verificamos que exista mas de un registro
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //regresamos todos los registros que existen en la tabla tipos_sangre.
    } else {
        return false; //en caso de no existir registros, regresamos false.
    }
}

// Función para registrar un nuevo usuario
function registrarUsuarioNormal($nombre, $apellido_pat, $apellido_mat, $telefono, $correo, $contra, $tipo_sangre)
{
    global $conn;
    try {
        $sql1 = "INSERT INTO usuarios(correo, contraseña, telefono, rol) VALUES(?, ?, ?, 1);";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([$correo, $contra, $telefono]);

        $id_usuario = $conn->lastInsertId();

        $sql2 = "INSERT INTO usuarios_normal(id_usuario, nombre, apellido_pat, apellido_mat, id_tipo_sangre) VALUES(?, ?, ?, ?, ?);";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$id_usuario, $nombre, $apellido_pat, $apellido_mat, $tipo_sangre]);
        return true; //retornamos true si se registró correctamente
    } catch (PDOException $e) {
        return false; // Si ocurre un error, regresamos false
    }
}

function registrarHospital($nombre_hospital, $correo, $direccion, $telefono, $contra)
{
    global $conn;
    try {
        $sql1 = "INSERT INTO usuarios(correo, contraseña, telefono, rol) VALUES(?, ?, ?, 2);";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([$correo, $contra, $telefono]);

        $id_usuario = $conn->lastInsertId();

        $sql2 = "INSERT INTO hospitales(id_usuario, nombre_hospital, direccion) VALUES(?, ?, ?);";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$id_usuario, $nombre_hospital, $direccion]);
        return true; //retornamos true si se registró correctamente
    } catch (PDOException $e) {
        return false; // Si ocurre un error, regresamos false
    }
}

function validarUsuario($correo)
{
    global $conn;
    $sql = "SELECT id_usuario, correo, contraseña, rol FROM usuarios where correo = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$correo]);
    if ($stmt->rowCount() > 0) {
        return $stmt->fetch(PDO::FETCH_ASSOC); //retorna el usuario si existe
    } else {
        return false; //retorna false si no existe el usuario
    }
}

function existeCorreo($correo)
{
    global $conn;
    //comprobamos si el correo ya existe en la base de datos mediante esta sentencia
    $sql = "SELECT count(*) as total_correos FROM usuarios WHERE correo = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$correo]);
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows && $rows['total_correos'] > 0; // Devuelve true si el correo ya existe, false en caso contrario
}

function obtenerCampanias()
{
    global $conn;
    $sql = "SELECT * FROM campanias;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorna todas las campañas si existen
    } else {
        return null; //retorna null si no existen campañas
    }
}