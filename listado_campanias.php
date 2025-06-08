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

        th {
            font-size: 1rem;
            font-weight: bold;
        }

        td {
            font-size: 1rem;
            font-weight: normal;
        }
    </style>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <!-- Sección principal -->
    <div class="main-section">
        <div class="main-content d-flex flex-column align-items-center m-5">
            <h2 class="text-center mb-4">LISTADO DE CAMPAÑAS</h2>
            <table class="table table-striped table-bordered text-center">
                <?php
                $rol = $_SESSION['rol']; // Obtener el rol del usuario desde la sesión, por defecto 0 si no está definido
                $encabezado_tablas = [];
                switch ($rol) {
                    case 1:
                    case 2:
                        $encabezado_tablas = ["TÍTULO", "DESCRIPCIÓN", "FECHA INICIO", "FECHA FIN", "CENTRO DONACION", "ACCIONES"];
                        break;
                    case 3:
                        $encabezado_tablas = ["ID", "TÍTULO", "DESCRIPCIÓN", "FECHA INICIO", "FECHA FIN", "CENTRO DONACION", "ACCIONES"];
                    default:
                        $encabezado_tablas = ["ID", "TÍTULO", "DESCRIPCIÓN", "FECHA INICIO", "FECHA FIN", "CENTRO DONACION", "ACCIONES"];
                        break;
                } ?>
                <thead>
                    <tr>
                        <?php foreach ($encabezado_tablas as $encabezado): ?>
                            <th><?php echo $encabezado; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'funciones.php';

                    $campanias = obtenerCampanias();

                    if ($campanias && is_array($campanias)) {
                        foreach ($campanias as $campania) {
                            switch ($rol) {
                                case 1:
                                case 2:
                                    echo "<tr>";
                                    echo "<td>" . $campania['titulo'] . "</td>";
                                    echo "<td>" . $campania['descripcion'] . "</td>";
                                    echo "<td>" . $campania['fecha_inicio'] . "</td>";
                                    echo "<td>" . $campania['fecha_fin'] . "</td>";
                                    echo "<td>" . $campania['id_centro_donacion'] . "</td>";

                                    if ($rol == 2) {
                                        echo "<td><a href='editar_campania.php?id=" . $campania['id_campaña']
                                            . "' class='btn btn-primary'>Editar</a></td>";
                                    } elseif ($rol == 1) {
                                        echo "<td><a href='editar_campania.php?id="
                                            . $campania['id_campaña'] . "' class='btn btn-primary'>Registrar</a></td>";
                                    }
                                    echo "</tr>";
                                    break;
                                case 3:
                                    echo "<tr>";
                                    echo "<td>" . $campania['id_campaña'] . "</td>";
                                    echo "<td>" . $campania['titulo'] . "</td>";
                                    echo "<td>" . $campania['descripcion'] . "</td>";
                                    echo "<td>" . $campania['fecha_inicio'] . "</td>";
                                    echo "<td>" . $campania['fecha_fin'] . "</td>";
                                    echo "<td>" . $campania['id_centro_donacion'] . "</td>";
                                    echo "<td><a href='editar_campania.php?id=" . $campania['id_campaña'] . "' class='btn btn-primary'>Editar</a>
                                            <a href='eliminar_campania.php?id=" . $campania['id_campaña'] . "' class='btn btn-danger'>Eliminar</a></td>";
                                    echo "</tr>";
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    include("footer.html");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>