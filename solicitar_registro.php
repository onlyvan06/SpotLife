<?php
require_once 'validar_sesion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>DONANTES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="styles/donantes_registro.css">
</head>

<body>
  <?php

    $personas = isset($_POST['personas']) ? $_POST['personas'] : "";
    $tipo_sangre = isset($_POST['tipo_sangre']) ? $_POST['tipo_sangre'] : "";
    $centro_donacion = isset($_POST['centro_donacion']) ? $_POST['centro_donacion'] : "";
    $mensaje = "";

    if (isset($personas) && $personas <> "" && isset($tipo_sangre) && $tipo_sangre <> "" && isset($centro_donacion) && $centro_donacion <> "") {
        $resultado = registrarDonantes($personas, $tipo_sangre, $centro_donacion, $_SESSION['id_usuario']);
        if ($resultado) {
          $mensaje = "<div class='alert alert-success text-center' id='overlay-exito' role='alert'>
                      Registro exitoso. Serás redirigido en 1.5 segundos...
                      </div>
                      <script>
                      setTimeout(function(){
                          window.location.href = 'solicitar_menu.php';
                      }, 1500);
                      </script>";
        } else {
          $mensaje = "<div class='alert alert-danger text-center' role='alert'>Error al registrar.</div>";
        }
      }
  ?>

  <div class="container-fluid h-100">
    <div class="row h-100 align-items-center" style="min-height:100vh;">
      <!-- Columna izquierda -->
      <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-5">
        <div class="contenedor_botones d-flex flex-column w-100 left-panel">
          <form action="" method="POST" name="solicitar_donantes" id="solicitar_donantes">
            <div class="mt-5">
              <label for="personas" class="form-label">Personas</label>
              <input type="number" class="form-control fs-4" name="personas" id="personas"
                placeholder="Número de personas necesarias" required>
            </div>

            <div class="mt-5">
              <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
              <select class="form-control fs-4" id="tipo_sangre" name="tipo_sangre"  readonly required>
                <option value="<?php $_SESSION['id_tipo_sangre']?>">
                  <?php
                  echo "$_SESSION[grupo_sanguineo]";
                  ?>
              </option>
              </select>
            </div>

            <div class="mt-5">
              <label for="centro_donacion" class="form-label">Centro de donación</label>
              <select class="form-control fs-4" id="centro_donacion" name="centro_donacion" required>
                <option value="" selected>Seleccione un centro de donación</option>
                <?php
                include_once 'funciones.php';
                $centros = obtenerCentrosDonacion();
                foreach ($centros as $centro) {
                  echo "<option value='" . $centro['id_centro_donacion'] . "'>" . $centro['centro_donacion'] . "</option>";
                }
                ?>
              </select>
            </div>

            <?php if ($mensaje != "") { echo $mensaje; } ?>

            <div class="d-flex justify-content-end mt-5 gap-3">
              <a href="solicitar_menu.php" class="btn btn-danger btn-custom w-25">CANCELAR</a>
              <button type="submit" class="btn btn-primary btn-custom w-25">ENVIAR</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Columna derecha -->
      <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center left-panel">
        <div class="right-panel">
          <p class="display-1">SOLICITAR DONANTES</p>
        </div>
      </div>

    </div>
  </div>

</body>

</html>