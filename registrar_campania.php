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
    <link rel="stylesheet" href="styles/registro.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <style>
        html,
        body {
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        body {
            display: grid;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: normal;
        }

        label {
            font-size: 1.3rem;
            font-weight: normal;
        }
    </style>
</head>

<body>
    <?php
    include("navbar.html");
    ?>
    <!-- Sección principal -->
    <div class="main-section">
        <div class="main-content">
            <form action="" method="POST" name="registrar_campania" id="registrar_campania" class="container mt-5">
                <h2 class="text-center mb-4">REGISTRAR CAMPAÑA</h2>
                <div class="mb-3">
                    <label for="nombre_campania" class="form-label">Nombre de la Campaña</label>
                    <input type="text" class="form-control" id="nombre_campania" name="nombre_campania" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                </div>
                <div class="mb-3">
                    <label for="centro_donacion" class="form-label">Centro de donación</label>
                    <input type="date" class="form-control" id="centrod" name="centrod" required>
                </div>
                <div class="mb-3 gap-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary">Registrar Campaña</button>
                    <a class="btn btn-primary" href="listado_campanias.php">Ver Campañas</a>
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