<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicita Donación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }
    .main-container {
      background: linear-gradient(to bottom right, #d9534f, #c9302c);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .form-box {
      background: white;
      padding: 2rem;
      border-radius: 10px;
    }
    .right-box {
      background: #f5f5f5;
      padding: 2rem;
      border-radius: 10px;
      text-align: center;
    }
    .btn-red {
      background: #d9534f;
      color: white;
      border: none;
    }
    .btn-blue {
      background: #2196f3;
      color: white;
      border: none;
    }
    .title-small {
      color: #2196f3;
    }
  </style>
</head>
<body>

<div class="main-container container-fluid">
  <div class="row w-75">
    <div class="col-md-6">
      <div class="form-box">
        <form>
          <input type="text" class="form-control mb-2" placeholder="Nombre">
          <div class="row mb-2">
            <div class="col"><input type="text" class="form-control" placeholder="Apellido Paterno"></div>
            <div class="col"><input type="text" class="form-control" placeholder="Apellido Materno"></div>
          </div>
          <input type="text" class="form-control mb-2" placeholder="Tipo de Sangre">
          <input type="date" class="form-control mb-3" placeholder="Fecha de Nacimiento">
          <div class="d-flex justify-content-between">
            <a href="solicitar_menu.php" class="btn btn-red">CANCELAR</a>
            <button type="submit" class="btn btn-blue">ENVIAR</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="right-box">
        <h4><span class="title-small">DATOS DEL</span><br><strong>PACIENTE</strong></h4>
      </div>
    </div>
  </div>
</div>

</body>
</html>

