<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda tu Cita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/cita_menu.css">
</head>

<body>

    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center" style="min-height:100vh;">
            <!-- Columna izquierda -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center left-panel">
                <div class="contendor_titulo">
                    <h1 class="display-1">AGENDA</h1>
                    <p class="h4">LLENA EL CUESTIONARIO CON LOS REQUISITOS PARA SER UN DONANTE VÁLIDO Y AGENDA TU CITA PARA APOYAR A ALGUIEN QUE LO NECESITA</p>
                </div>
            </div>
            <!-- Columna derecha -->
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
                <div class="contenedor_botones d-flex flex-column w-100 right-panel">
                    <p class="display-3 text-center"><span id="color1">SPOT</span><span id="color2">LIFE</span></p>
                    <a href="cita_cuestionario.php" class="btn btn-primary btn-custom mb-3 w-100">AGENDAR CITA</a>
                    <button class="btn btn-outline-primary btn-custom mb-3 w-100">BUSCAR CITA</button>
                    <a href="inicio.php" class="btn btn-danger btn-custom w-100">REGRESAR</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>