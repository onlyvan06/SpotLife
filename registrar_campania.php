<?php
require_once 'validar_sesion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CAMPAÑAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/registrar_campania.css">
</head>

<body>
    <?php
    include("navbar.php");
    ?>

    <?php
    include_once 'funciones.php';
    $nombre_campania = isset($_POST['nombre_campania']) ? $_POST['nombre_campania'] : "";
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : "";
    $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : "";
    $centro_donacion = isset($_POST['centro_donacion']) ? $_POST['centro_donacion'] : "";

    $mensaje = "";

    if (isset($nombre_campania) && $nombre_campania <> "" && isset($descripcion) && $descripcion <> "" && isset($fecha_inicio) && $fecha_inicio <> "" && isset($centro_donacion) && $centro_donacion <> "") {

        $registro_campania = registrarCampania($nombre_campania, $descripcion, $fecha_inicio, $fecha_fin, $centro_donacion);
        if ($registro_campania) {
            $mensaje = "<div class='alert alert-success text-center' id='overlay-exito' role='alert'> !Registro exitoso?¡ </div>";
        } else {
            $mensaje = "<div class='alert alert-danger text-center' role='alert'>Error al registrar</div>";
        }
    }
    ?>

    <!-- Sección principal -->
    <div class="main-section">
        <div class="main-content">
            <form action="registrar_campania.php" method="POST" name="registrar_campania" name="registrar_campania" id="registrar_campania" class="container mt-5">
                <h2 class="text-center mb-4">REGISTRAR CAMPAÑA</h2>
                
                <?php if ($mensaje != "") {
                    echo $mensaje;
                } ?>

                <div class="mb-3">
                    <label for="nombre_campania" class="form-label">Nombre de la Campaña</label>
                    <input type="text" class="form-control fs-4" id="nombre_campania" name="nombre_campania" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control fs-4" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control fs-4" id="fecha_fin" name="fecha_fin" required>
                </div>
                <div class="mb-5">
                    <label for="centro_donacion" class="form-label">Centro de donación</label>
                    <select class="form-control fs-4" id="centro_donacion" name="centro_donacion" required>
                        <option value="" selected>Seleccione un centro de donación</option>
                        <?php
                        $centros = obtenerCentrosDonacion();
                        foreach ($centros as $centro) {
                            echo "<option value='" . $centro['id_centro_donacion'] . "'>" . $centro['centro_donacion'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-5 gap-5 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary" form="registrar_campania">REGISTRAR CAMPAÑA</button>
                    <a class="btn btn-primary" href="listado_campanias.php">VER CAMPAÑAS</a>
                    <button type="reset" class="btn btn-primary" form="registrar_campania">LIMPIAR</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include("footer.html");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>