<?php
require_once 'validar_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/cita_cuestionario.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>

<body>

    <?php
    include("navbar.php");
    ?>

    <?php

    // Obtener parámetros del formulario
    $vacuna = isset($_POST['vacuna']) ? $_POST['vacuna'] : null;
    $dental = isset($_POST['dental']) ? $_POST['dental'] : null;
    $tatuaje = isset($_POST['tatuaje']) ? $_POST['tatuaje'] : null;
    $sintomas = isset($_POST['sintomas']) ? $_POST['sintomas'] : null;
    $peso = isset($_POST['peso']) ? $_POST['peso'] : null;
    $drogas = isset($_POST['drogas']) ? $_POST['drogas'] : null;
    $analgesicos = isset($_POST['analgesicos']) ? $_POST['analgesicos'] : null;
    $salud = isset($_POST['salud']) ? $_POST['salud'] : null;

    $mensaje = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar que todos los campos estén presentes
        if (
            $vacuna === null || $dental === null || $tatuaje === null || $sintomas === null ||
            $drogas === null || $analgesicos === null || $peso === null || $salud === null
        ) {
            $mensaje = "<div class='alert alert-danger text-center h5' role='alert'>Por favor responde todas las preguntas.</div>";
        } else if (
            $vacuna === "no" && $dental === "no" && $tatuaje === "no" && $sintomas === "no" &&
            $drogas === "no" && $analgesicos === "no" && $peso === "si" && $salud === "si"
        ) {
            $mensaje = "<div class='alert alert-success text-center h5' id='overlay-exito' role='alert'>Cumples con los requisitos, puedes agendar tu cita!</div>
                    <script>
                        // Redireccionar después de 1.5 segundos (1500 ms)
                        setTimeout(function () {
                            window.location.href = 'cita_registro.php';
                        }, 1500);
                    </script>";
        } else {
            $mensaje = "<div class='alert alert-danger text-center h5' role='alert'>No cumples con los requisitos para poder donar.</div>";
        }
    }
    ?>

    <div class="container text-start">
        <p class="h5 ml-5 mr-5 text-justify mt-5">Para ser un donador apto tiene que llenar el siguiente cuestionario.
            En caso de no
            cumplir con los
            requerimientos no tendrá la posibilidad de donar.</p>

        <div class="question ml-5 mr-5 ">
            <form action="" method="POST" name="cuestionario" id="cuestionario">
                <!-- Pregunta 1 -->
                <div class="mb-2">
                    <label class="form-label mt-2">¿Se ha vacunado en el último mes?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="vacuna" id="vacuna_si" value="si">
                        <label class="form-check-label" for="vacuna_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="vacuna" id="vacuna_no" value="no">
                        <label class="form-check-label" for="vacuna_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 2 -->
                <div class="mb-2">
                    <label class="form-label mt-2">¿Se ha realizado algún tratamiento dental?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="dental" id="dental_si" value="si">
                        <label class="form-check-label" for="dental_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="dental" id="dental_no" value="no">
                        <label class="form-check-label" for="dental_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 3 -->
                <div class="mb-2">
                    <label class="form-label mt-2">¿Se ha realizado algún tatuaje en los últimos 12 meses?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="tatuaje" id="tatuaje_si" value="si">
                        <label class="form-check-label" for="tatuaje_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="tatuaje" id="tatuaje_no" value="no">
                        <label class="form-check-label" for="tatuaje_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 4 -->
                <div class="mb-3">
                    <label class="form-label mt-2">¿Ha presentado algún síntoma de alguna enfermedad estos días?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="sintomas" id="sintomas_si"
                            value="si">
                        <label class="form-check-label" for="sintomas_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="sintomas" id="sintomas_no"
                            value="no">
                        <label class="form-check-label" for="sintomas_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 5 -->
                <div class="mb-3">
                    <label class="form-label mt-2">¿Pesas más de 50kg?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="peso" id="peso_si" value="si">
                        <label class="form-check-label" for="peso_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="peso" id="peso_no" value="no">
                        <label class="form-check-label" for="peso_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 6 -->
                <div class="mb-3">
                    <label class="form-label mt-2">¿Has usado drogas en los últimos 12 meses?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="drogas" id="drogas_si" value="si">
                        <label class="form-check-label" for="drogas_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="drogas" id="drogas_no" value="no">
                        <label class="form-check-label" for="drogas_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 7 -->
                <div class="mb-3">
                    <label class="form-label mt-2">¿Has tomado analgésicos en el último mes?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="analgesicos" id="analgesicos_si"
                            value="si">
                        <label class="form-check-label" for="analgesicos_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="analgesicos" id="analgesicos_no"
                            value="no">
                        <label class="form-check-label" for="analgesicos_no">No</label>
                    </div>
                </div>
                <!-- Pregunta 8 -->
                <div class="mb-3">
                    <label class="form-label mt-2">¿Consideras que tienes buena salud?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="salud" id="salud_si" value="si">
                        <label class="form-check-label" for="salud_si">Sí</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input radio-lg" type="radio" name="salud" id="salud_no" value="no">
                        <label class="form-check-label" for="salud_no">No</label>
                    </div>
                </div>

                <?php
                if ($mensaje != "") {
                    echo $mensaje;
                }
                ?>

                <div class="buttons mb-4">
                    <a href="cita_menu.php" class="btn btn-danger w-25">CANCELAR</a>
                    <button type="submit" class="btn btn-primary w-25" form="cuestionario">SIGUIENTE</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    include("footer.html");
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>