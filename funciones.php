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

function registrarDonantes($personas, $tipo_sangre, $centro_donacion, $id_usuario)
{
    global $conn;
    try {
        $sql = "INSERT INTO solicitudes(personas, estado, fecha_registro, id_centro, id_tipo_sangre, id_usuario) VALUES(?, 'PENDIENTES', NOW(), ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$personas, $tipo_sangre, $centro_donacion, $id_usuario]);
        return true; //retornamos true si se registró correctamente
    } catch (PDOException $e) {
        return false; // Si ocurre un error, regresamos false
    }
}

function registrarCampania($titulo, $descripcion, $fecha_inicio, $fecha_fin, $centro_donacion)
{
    global $conn;
    try {
        $sql = "INSERT INTO campanias(titulo, descripcion, fecha_inicio, fecha_fin, id_centro_donacion) VALUES(?, ?, ?, ?, ?);";
        $stmt = $conn->prepare(query: $sql);
        $stmt->execute([$titulo, $descripcion, $fecha_inicio, $fecha_fin, $centro_donacion]);
        return true; //retornamos true si se registró correctamente
    } catch (PDOException $e) {
        return false; // Si ocurre un error, regresamos false
    }
}

function validarUsuario($correo)
{
    global $conn;
    // Primero buscamos el usuario y que este exista
    $sql = "SELECT * FROM usuarios WHERE correo = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$correo]);
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        // Despues si es usuario normal (rol 1), busca los datos extra que necesitamos para guardar en la sesión del usuario
        if ($usuario['rol'] == 1) {
            $sql2 = "SELECT un.id_tipo_sangre, un.nombre, ts.grupo_sanguineo FROM usuarios_normal as un JOIN tipos_sangre as ts ON un.id_tipo_sangre = ts.id_tipo_sangre WHERE un.id_usuario = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$usuario['id_usuario']]);
            if ($stmt2->rowCount() > 0) {
                $extra = $stmt2->fetch(PDO::FETCH_ASSOC);
                $usuario = array_merge($usuario, $extra);
            }
        }
        // E igual con el hospital, si es hospital (rol 2), busca los datos extra que se van a guardar en la sesión del hospital
        if ($usuario['rol'] == 2) {
            $sql2 = "SELECT nombre_hospital, aprobacion FROM hospitales WHERE id_usuario = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$usuario['id_usuario']]);
            if ($stmt2->rowCount() > 0) {
                $extra = $stmt2->fetch(PDO::FETCH_ASSOC);
                $usuario = array_merge($usuario, $extra);
            }
        }
        return $usuario;
    } else {
        return false;
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

function obtenerCentrosDonacion()
{
    global $conn;
    $sql = "SELECT * FROM centros_donacion;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorna todos los centros de donación si existen
    } else {
        return null; //retorna null si no existen centros de donación
    }
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