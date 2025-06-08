<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>REGISTRO - HOSPITAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/registro.css">
</head>

<body>
    <?php
    include_once 'funciones.php';
    $nombre_hospital = isset($_POST['nombre_hospital']) ? $_POST['nombre_hospital'] : "";
    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : "";
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
    $contra = isset($_POST['contra']) ? $_POST['contra'] : "";
    $confirmar_contra = isset($_POST['confirmar_contra']) ? $_POST['confirmar_contra'] : "";

    $mensaje = ""; // Esta variable se utilizará para mostrar mensajes ya sea de éxito o error.
    
    if (isset($nombre_hospital) && $nombre_hospital <> "" && isset($correo) && $correo <> "" && isset($direccion) && $direccion <> "" && isset($telefono) && $telefono <> "" && isset($contra) && $contra <> "") {
        
        if ($contra == $confirmar_contra) {
            // Verificamos si el correo ya existe
            $existe_correo = existeCorreo($correo);
            if ($existe_correo) {
                $mensaje = "<div class='alert alert-danger text-center' role='alert'>El correo ya está registrado.</div>";
            } else {
                $resultado = registrarHospital($nombre_hospital, $correo, $direccion, $telefono, $contra);
                if ($resultado) {
                    $mensaje = "<div class='alert alert-success text-center' id='overlay-exito' role='alert'>
                                Registro exitoso. Serás redirigido en 2 segundos...
                                </div>
                                <script>
                                setTimeout(function(){
                                    window.location.href = 'index.php';
                                }, 2000);
                                </script>";
                } else {
                    $mensaje = "<div class='alert alert-danger text-center' role='alert'>Error al registrar.</div>";
                }
            }

        }
        else{
            $mensaje = "<div class='alert alert-danger text-center' role='alert'>Las contraseñas no coinciden</div>";
        }
    }
    ?>

    <div class="row g-0">
        <!-- Lado izquierdo -->
        <div class="col-md-5 left text-center">
            <h1><span id="span_spot" class="text-white">SPOT</span><span id="span_life" class="">LIFE</span></h1>
            <div class="">
                <p class="text-white">¡Regístrate!</p>
            </div>
        </div>

        <!-- Lado derecho -->
        <div class="col-md-7 right align-items-center">
            <h1 class="">REGÍSTRATE</h1>
            <form action="registro_hospital.php" method="POST" class="input-group-lg d-flex flex-column w-50">
                <input type="text" name="nombre_hospital" id="nombre_hospital" class="form-control mb-2"
                    placeholder="Nombre de Hospital" required>
                <input type="email" name="correo" id="correo" class="form-control mb-2" placeholder="Correo" required>
                <input type="text" name="direccion" id="direccion" class="form-control mb-2" placeholder="Dirección" required>
                <input type="text" name="telefono" id="telefono" class="form-control mb-2" placeholder="Teléfono" required>
                <input type="password" name="contra" id="contra" class="form-control mb-2" placeholder="Contraseña" required>
                <input type="password" name="confirmar_contra" id="confirmar_contra" class="form-control mb-2"
                    placeholder="Confirmar Contraseña" required>
                <button type="submit" class="btn btn-blue w-100">REGISTRAR</button>
                <a href="index.php" class="btn btn-red mb-3 mt-2 justify-content-center">REGRESAR</a>
                <?php
                if ($mensaje != "") {
                    echo $mensaje;
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>