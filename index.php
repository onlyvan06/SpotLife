<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO DE SESIÓN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>

    <?php
    include_once 'funciones.php';

    $correo = isset($_POST['correo']) ? $_POST['correo'] : "";
    $contrasenia = isset($_POST['contra']) ? $_POST['contra'] : "";
    $mensaje = "";

    if (isset($_POST['correo']) && $correo <> "" && isset($_POST['contra']) && $contrasenia <> "") {
        $usuario = validarUsuario($correo);
        if (is_array($usuario) && isset($usuario['id_usuario']) && isset($usuario['correo']) && isset($usuario['rol']) && isset($usuario['contraseña'])) {
            
            if ($contrasenia != $usuario['contraseña']) {
                $mensaje = "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
            } else {
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['rol'] = $usuario['rol'];
                header("Location: inicio.php");
            }
        } else {
            $mensaje = "<div class='alert alert-danger'>Correo no registrado.</div>";
        }
    }
    ?>
    <div class="row g-0">
        <!-- Lado izquierdo -->
        <div class="col-md-7 left text-center align-items-center">
            <h1 class="mb-4 text-center">INICIO DE SESIÓN</h1>
            <form action="index.php" method="POST" class="input-group-lg">
                <input type="email" name="correo" id="correo" class="form-control mb-3 w-100" placeholder="Correo"
                    required>
                <input type="password" name="contra" id="contra" class="form-control mb-4 place-holder w-100"
                    placeholder="Contraseña" required>
                <input type="submit" class="btn btn-blue mb-4 fs-5 w-100" value="INICIAR">
                <?php if ($mensaje != "")
                    echo $mensaje; ?>
            </form>

            <div>
                <span id="span_spot" class="fs-4">SPOT</span><span id="span_life" class="fs-4">LIFE</span><br>
            </div>
        </div>

        <!-- Lado derecho -->
        <div class="col-md-5 right text-center">
            <h1 class="text-center">BIENVENIDO</h1>
            <p class="px-5 mt-3 fs-5">El poder de cambiar muchas vidas está en tus manos. Si no tienes una cuenta puedes
                registrarte aquí.</p>
            <a href="registro.php" class="btn btn-red mt-2 px-4 fs-5 w-50">REGÍSTRATE</a>
        </div>
    </div>
</body>

</html>