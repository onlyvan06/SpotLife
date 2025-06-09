// Conexión a la base de datos SPOTLIFE
include_once 'conexionBD.php';
// =======================
// FUNCIONES DE CONSULTA (VISTAS)
// =======================

function campañasActivas() {
global $conn;
$sql = "SELECT * FROM vista_campañas_activas;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function citasDonante($ID_user) {
global $conn;
$sql = "SELECT * FROM vista_citas_por_donante WHERE id_usuario = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$ID_user]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function citasProgramadasCentros() {
global $conn;
$sql = "SELECT * FROM vista_citas_programadas_centros;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donantesActivos() {
global $conn;
$sql = "SELECT * FROM vista_donantes_activos;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donanteActivo($ID_user) {
global $conn;
$sql = "SELECT * FROM vista_donantes_activos WHERE id_usuario = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$ID_user]);
return $stmt->fetch(PDO::FETCH_ASSOC);
}

function solicitudDonante($ID_user) {
global $conn;
$sql = "SELECT * FROM vista_solicitudes_por_donante WHERE id_usuario = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$ID_user]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function resumenDonante($ID_user) {
global $conn;
$sql = "SELECT * FROM vista_consolidada_donante WHERE id_usuario = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$ID_user]);
return $stmt->fetch(PDO::FETCH_ASSOC);
}

function historialDonaciones($ID_user) {
global $conn;
$sql = "SELECT * FROM vista_historial_donaciones_usuario WHERE id_usuario = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$ID_user]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function horariosAtencion() {
global $conn;
$sql = "SELECT * FROM vista_horarios_atencion_centros;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function inventarioSangre() {
global $conn;
$sql = "SELECT * FROM vista_inventario_sangre_centros;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function donantesCompatibles($id_solicitud) {
global $conn;
$sql = "SELECT * FROM vista_donantes_compatibles_solicitud WHERE id_solicitud = ?;";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_solicitud]);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function transfusionesRealizadas() {
global $conn;
$sql = "SELECT * FROM vista_transfusiones_realizadas;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function estadisticasDonacionesMensuales() {
global $conn;
$sql = "SELECT * FROM vista_estadisticas_donaciones_mensuales;";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// =======================
// FUNCIONES CRUD BÁSICAS
// =======================

function registrarUsuario($correo, $contrasena, $telefono, $rol, $nombre, $direccion = null, $tipo_sangre = null, $es_hospital = 0) {
global $conn;
$hash = password_hash($contrasena, PASSWORD_BCRYPT);
$sql = "INSERT INTO usuarios (correo, contrasena, telefono, rol, nombre_completo, direccion, id_tipo_sangre, es_hospital) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
return $stmt->execute([$correo, $hash, $telefono, $rol, $nombre, $direccion, $tipo_sangre, $es_hospital]);
}

function agendarCita($id_usuario, $id_centro, $fecha_hora, $codigo_cita) {
global $conn;
$sql = "INSERT INTO citas (id_usuario, id_centro_donacion, fecha_hora, codigo_cita) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
return $stmt->execute([$id_usuario, $id_centro, $fecha_hora, $codigo_cita]);
}

function registrarDonacion($id_usuario, $id_centro, $id_tipo_sangre, $cantidad_ml, $fecha_donacion, $fecha_expiracion) {
global $conn;
$sql = "INSERT INTO donaciones (id_usuario, id_centro_donacion, id_tipo_sangre, cantidad_ml, fecha_donacion, fecha_expiracion) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
return $stmt->execute([$id_usuario, $id_centro, $id_tipo_sangre, $cantidad_ml, $fecha_donacion, $fecha_expiracion]);
}

function registrarSolicitud($cantidad_ml, $id_centro, $id_tipo_sangre, $id_usuario, $motivo, $prioridad = 'MEDIA', $notas = null) {
global $conn;
$sql = "INSERT INTO solicitudes (cantidad_ml, id_centro, id_tipo_sangre, id_usuario, motivo, prioridad, notas) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
return $stmt->execute([$cantidad_ml, $id_centro, $id_tipo_sangre, $id_usuario, $motivo, $prioridad, $notas]);
}
?>