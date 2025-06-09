<?php
// Conexión a la base de datos SPOTLIFE
include_once 'conexionBD.php';

// FUNCIONES DE CONSULTA (VISTAS)
function campañasActivas()
{
    global $conn;
    $sql = "SELECT * FROM vista_campañas_activas;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function citasDonante($ID_user)
{
    global $conn;
    $sql = "SELECT * FROM vista_citas_por_donante WHERE id_usuario = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ID_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function citasProgramadasCentros()
{
    global $conn;
    $sql = "SELECT * FROM vista_citas_programadas_centros;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donantesActivos()
{
    global $conn;
    $sql = "SELECT * FROM vista_donantes_activos;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donanteActivo($ID_user)
{
    global $conn;
    $sql = "SELECT * FROM vista_donantes_activos WHERE id_usuario = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ID_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function solicitudDonante($ID_user)
{
    global $conn;
    $sql = "SELECT * FROM vista_solicitudes_por_donante WHERE id_usuario = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ID_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function resumenDonante($ID_user)
{
    global $conn;
    $sql = "SELECT * FROM vista_consolidada_donante WHERE id_usuario = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ID_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function historialDonaciones($ID_user)
{
    global $conn;
    $sql = "SELECT * FROM vista_historial_donaciones_usuario WHERE id_usuario = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$ID_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function horariosAtencion()
{
    global $conn;
    $sql = "SELECT * FROM vista_horarios_atencion_centros;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function inventarioSangre()
{
    global $conn;
    $sql = "SELECT * FROM vista_inventario_sangre_centros;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donantesCompatibles($id_solicitud)
{
    global $conn;
    $sql = "SELECT * FROM vista_donantes_compatibles_solicitud WHERE id_solicitud = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_solicitud]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function transfusionesRealizadas()
{
    global $conn;
    $sql = "SELECT * FROM vista_transfusiones_realizadas;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function estadisticasDonacionesMensuales()
{
    global $conn;
    $sql = "SELECT * FROM vista_estadisticas_donaciones_mensuales;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// FUNCIONES BÁSICAS
function registrarUsuario($correo, $contrasena, $telefono, $rol, $nombre, $direccion = null, $tipo_sangre = null, $es_hospital = 0)
{
    global $conn;
    $hash = password_hash($contrasena, PASSWORD_BCRYPT);
    $sql = "INSERT INTO usuarios (correo, contrasena, telefono, rol, nombre_completo, direccion, id_tipo_sangre, es_hospital) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$correo, $hash, $telefono, $rol, $nombre, $direccion, $tipo_sangre, $es_hospital]);
}

function agendarCita($id_usuario, $id_centro, $fecha_hora, $codigo_cita)
{
    global $conn;
    $sql = "INSERT INTO citas (id_usuario, id_centro_donacion, fecha_hora, codigo_cita) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id_usuario, $id_centro, $fecha_hora, $codigo_cita]);
}

function registrarDonacion($id_usuario, $id_centro, $id_tipo_sangre, $cantidad_ml, $fecha_donacion, $fecha_expiracion)
{
    global $conn;
    $sql = "INSERT INTO donaciones (id_usuario, id_centro_donacion, id_tipo_sangre, cantidad_ml, fecha_donacion, fecha_expiracion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id_usuario, $id_centro, $id_tipo_sangre, $cantidad_ml, $fecha_donacion, $fecha_expiracion]);
}

function registrarSolicitud($cantidad_ml, $id_centro, $id_tipo_sangre, $id_usuario, $motivo, $prioridad = 'MEDIA', $notas = null)
{
    global $conn;
    $sql = "INSERT INTO solicitudes (cantidad_ml, id_centro, id_tipo_sangre, id_usuario, motivo, prioridad, notas) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$cantidad_ml, $id_centro, $id_tipo_sangre, $id_usuario, $motivo, $prioridad, $notas]);
}

// USUARIOS
function autenticarUsuario($correo, $contrasena)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND activo = 1");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        return $usuario;
    }
    return null;
}

function listarUsuariosPorRol($rol)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE rol = ?");
    $stmt->execute([$rol]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// CITAS
function obtenerCitasPorCentro($id_centro)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM citas WHERE id_centro_donacion = ?");
    $stmt->execute([$id_centro]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cancelarCita($id_cita, $motivo)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE citas SET estado = 'CANCELADA', motivo_cancelacion = ?, fecha_actualizacion = NOW() WHERE id_cita = ?");
    return $stmt->execute([$motivo, $id_cita]);
}

function actualizarEstadoCita($id_cita, $estado)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE citas SET estado = ?, fecha_actualizacion = NOW() WHERE id_cita = ?");
    return $stmt->execute([$estado, $id_cita]);
}

// DONACIONES
function aprobarDonacion($id_donacion)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE donaciones SET estado = 'ALMACENADA', aprobada = 1 WHERE id_donacion = ?");
    return $stmt->execute([$id_donacion]);
}

function usarDonacion($id_donacion)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE donaciones SET estado = 'UTILIZADA' WHERE id_donacion = ?");
    return $stmt->execute([$id_donacion]);
}

function descartarDonacion($id_donacion, $motivo)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE donaciones SET estado = 'DESCARTADA', notas = ? WHERE id_donacion = ?");
    return $stmt->execute([$motivo, $id_donacion]);
}

// INVENTARIO
function actualizarInventario($id_centro, $id_tipo_sangre, $cantidad_ml, $tipo_movimiento, $id_usuario, $id_donacion = null, $id_solicitud = null, $motivo = null)
{
    global $conn;

    $stmt = $conn->prepare("SELECT id_inventario FROM inventario_sangre WHERE id_centro_donacion = ? AND id_tipo_sangre = ?");
    $stmt->execute([$id_centro, $id_tipo_sangre]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $id_inventario = $row['id_inventario'];
        if ($tipo_movimiento == 'ENTRADA') {
            $conn->prepare("UPDATE inventario_sangre SET cantidad_ml = cantidad_ml + ?, fecha_actualizacion = NOW() WHERE id_inventario = ?")
                ->execute([$cantidad_ml, $id_inventario]);
        } elseif ($tipo_movimiento == 'SALIDA') {
            $conn->prepare("UPDATE inventario_sangre SET cantidad_ml = cantidad_ml - ?, fecha_actualizacion = NOW() WHERE id_inventario = ?")
                ->execute([$cantidad_ml, $id_inventario]);
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO inventario_sangre (id_centro_donacion, id_tipo_sangre, cantidad_ml) VALUES (?, ?, ?)");
        $stmt->execute([$id_centro, $id_tipo_sangre, $cantidad_ml]);
        $id_inventario = $conn->lastInsertId();
    }

    $stmt = $conn->prepare("INSERT INTO registro_inventario (id_inventario, tipo_movimiento, cantidad_ml, id_usuario, id_donacion, id_solicitud, motivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$id_inventario, $tipo_movimiento, $cantidad_ml, $id_usuario, $id_donacion, $id_solicitud, $motivo]);
}

function obtenerInventarioPorCentro($id_centro)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM inventario_sangre WHERE id_centro_donacion = ?");
    $stmt->execute([$id_centro]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// SOLICITUDES
function aprobarSolicitud($id_solicitud, $id_donacion)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE solicitudes SET estado = 'APROBADA', id_donacion = ?, fecha_respuesta = NOW() WHERE id_solicitud = ?");
    return $stmt->execute([$id_donacion, $id_solicitud]);
}

function rechazarSolicitud($id_solicitud, $motivo)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE solicitudes SET estado = 'RECHAZADA', motivo = ?, fecha_respuesta = NOW() WHERE id_solicitud = ?");
    return $stmt->execute([$motivo, $id_solicitud]);
}

function completarSolicitud($id_solicitud)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE solicitudes SET estado = 'COMPLETADA', fecha_respuesta = NOW() WHERE id_solicitud = ?");
    return $stmt->execute([$id_solicitud]);
}

// TRANSFUSIONES
function registrarTransfusion($fecha, $cantidad_ml, $id_donacion, $id_paciente, $id_centro, $id_medico, $diagnostico, $resultado, $notas)
{
    global $conn;
    $sql = "INSERT INTO transfusiones (fecha_transfusion, cantidad_ml, id_donacion, id_paciente, id_centro_donacion, id_medico, diagnostico, resultado, notas)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$fecha, $cantidad_ml, $id_donacion, $id_paciente, $id_centro, $id_medico, $diagnostico, $resultado, $notas]);
}

function obtenerHistorialTransfusiones($id_paciente)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM transfusiones WHERE id_paciente = ? ORDER BY fecha_transfusion DESC");
    $stmt->execute([$id_paciente]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// PACIENTES
function registrarPaciente($nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $id_tipo_sangre, $genero, $historial, $alergias, $contacto, $telefono)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO pacientes (nombre, apellido_paterno, apellido_materno, fecha_nacimiento, id_tipo_sangre, genero, historial_medico, alergias, contacto_emergencia, telefono_emergencia)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $id_tipo_sangre, $genero, $historial, $alergias, $contacto, $telefono]);
}

function editarPaciente($id, $nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $id_tipo_sangre, $genero, $historial, $alergias, $contacto, $telefono)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE pacientes SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, fecha_nacimiento = ?, id_tipo_sangre = ?, genero = ?, historial_medico = ?, alergias = ?, contacto_emergencia = ?, telefono_emergencia = ? WHERE id_paciente = ?");
    return $stmt->execute([$nombre, $apellido_paterno, $apellido_materno, $fecha_nacimiento, $id_tipo_sangre, $genero, $historial, $alergias, $contacto, $telefono, $id]);
}

function obtenerPacientes()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM pacientes");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerPaciente($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM pacientes WHERE id_paciente = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// UTILIDADES
function generarCodigoCita($longitud = 10)
{
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $longitud);
}

function validarDisponibilidadHorario($id_centro, $fecha_hora)
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM citas WHERE id_centro_donacion = ? AND fecha_hora = ? AND estado = 'PROGRAMADA'");
    $stmt->execute([$id_centro, $fecha_hora]);
    return $stmt->fetchColumn() == 0;
}
