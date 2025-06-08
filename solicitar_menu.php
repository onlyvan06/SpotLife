<?php
 require_once 'validar_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Solicita Donación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/donantes_menu.css">
    <script>
        function init() {
            var btn = document.getElementById("mostrar_overlay");
            btn.addEventListener("click", function () {
                addOverlay();
            });
        }

        function addOverlay() {
            var overlay = document.getElementById("overlay");
            overlay.style.display = "block";
        }

        window.onload = init;
    </script>
</head>

<body>

    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center" style="min-height:100vh;">
            <!-- Columna izquierda -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center left-panel">
                <div class="contendor_titulo">
                    <h1 class="display-1">DONANTES</h1>
                    <p class="h4">ENCUENTRA PERSONAS QUE ESTAN DISPUESTAS A SER TU GOTA DE VIDA REGISTRANDO UNA
                        SOLICITUD </p>
                </div>
            </div>
            <!-- Columna derecha -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
                <div class="contenedor_botones d-flex flex-column w-100 right-panel">
                    <p class="display-3 text-center"><span id="color1">SPOT</span><span id="color2">LIFE</span></p>
                    <button class="btn btn-primary btn-custom mb-3 w-100" id="mostrar_overlay">SOLICITAR
                        DONANTES</button>
                    <button class="btn btn-outline-primary btn-custom mb-3 w-100">VER SOLICITUDES</button>
                    <a href="inicio.php" class="btn btn-danger btn-custom w-100">REGRESAR</a>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay" id="overlay" style="display: none">
        <div class="overlay-mensaje d-flex flex-column justify-content-center align-items-center text-center p-5 w-auto h-auto">
            <p class='h3 mb-5'>¿Quieres hacer la solicitud para ti o para un familiar?</p>
            <a href="solicitar_registro.php" class="btn btn-blue w-25 mb-4 h4">PARA MI</a>
            <a href="solicitar_paciente.php" class="btn btn-alert w-25 mb-4 h4">FAMILIAR</a>
            <a href="solicitar_menu.php" class="btn btn-red-outline w-25 h4">CANCELAR</a>
        </div>
    </div>
</body>

</html>