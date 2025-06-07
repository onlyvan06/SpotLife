<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>REGISTRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/registro.css">
    <link rel="stylesheet" href="styles/navbar.css">
</head>

<body>
    <?php
    include_once 'funciones.php';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $apellido_pat = isset($_POST['apellido_pat']) ? $_POST['apellido_pat'] : "";
    $apellido_mat = isset($_POST['apellido_mat']) ? $_POST['apellido_mat'] : "";
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : "";
    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
    $contra = isset($_POST['contra']) ? $_POST['contra'] : "";
    $confirmar_contra = isset($_POST['confirmar_contra']) ? $_POST['confirmar_contra'] : "";
    $tipo_sangre = isset($_POST['tipo_sangre']) ? $_POST['tipo_sangre'] : "";

    $mensaje = ""; //Esta variable se utilizarzá para mostrar mensajes ya sea de exito o error.
    
    if (isset($nombre) && $nombre <> "" && isset($apellido_pat) && $apellido_pat <> "" && isset($apellido_mat) && $apellido_mat <> "" && isset($telefono) && $telefono <> "" && isset($correo) && $correo <> "" && isset($contra) && $contra <> "" && isset($confirmar_contra) && $confirmar_contra <> "" && isset($tipo_sangre) && $tipo_sangre <> "") {
        //Verificamos que la contraseña y la confirmación de contraseña sean iguales.
        //ya que no se puede generar el registro si no las contraseñas no son iguales.
    
        if ($contra == $confirmar_contra) {
            $existe_correo = existeCorreo($correo);
            if ($existe_correo) {
                $mensaje = "<div class='alert alert-danger text-center' role='alert'>El correo ya está registrado.</div>";
            } else {
                $resultado = registrarUsuarioNormal( $nombre, $apellido_pat, $apellido_mat, $telefono, $correo, $contra, $tipo_sangre);
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
        } else {
            $mensaje = "<div class='alert alert-danger text-center' role='alert'>Las contraseñas no coinciden</div>";
        }
    }

    ?>
    <div class="row g-0">
        <!-- Lado izquierdo -->
        <div class="col-md-5 left text-center">
            <h1><span id="span_spot" class="text-white">SPOT</span><span id="span_life" class="">LIFE</span></h1>
            <div class="">
                <p class="text-white">¿Deseas registrarte como una institución médica?<a class="negritas"
                        href="registro_hospital.php"><span> Registrate aquí.</span></a></p>
            </div>
        </div>

        <!-- Lado derecho -->
        <div class="col-md-7 right align-items-center">
            <h1 class="">REGÍSTRATE</h1>
            <form action="registro.php" method="POST" class="input-group-lg d-flex flex-column w-50">
                <input type="text" class="form-control mb-2" name="nombre" id="nombre" placeholder="Nombre" required>
                <input type="text" class="form-control mb-2" name="apellido_pat" id="apellido_pat"
                    placeholder="Apellido Paterno" required>
                <input type="text" class="form-control mb-2" name="apellido_mat" id="apellido_mat"
                    placeholder="Apellido Materno">
                <input type="email" class="form-control mb-2" name="correo" id="correo" placeholder="Correo" required>
                <input type="text" class="form-control mb-2" name="telefono" id="telefono" placeholder="Teléfono"
                    required>
                <input type="password" class="form-control mb-2" name="contra" id="contra" placeholder="Contraseña"
                    required>
                <input type="password" class="form-control mb-2" name="confirmar_contra" id="confirmar_contra"
                    placeholder="Confirmar Contraseña" required>
                <select class="form-control mb-4" name="tipo_sangre" id="tipo_sangre" required>
                    <option value="">Tipo de Sangre</option>
                    <?php
                    //Mostramos el listado de tipos de sangre dentro del select
                    include_once 'funciones.php';
                    $tipos_sangre = listadoTiposSangre();
                    if ($tipos_sangre) {
                        foreach ($tipos_sangre as $tipo) {
                            echo "<option value='" . $tipo['id_tipo_sangre'] . "'>" . $tipo['grupo_sanguineo'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay registros</option>";
                    }
                    ?>
                </select>
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