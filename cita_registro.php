<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/cita_registro.css">
    <title>Registra tu Cita</title>
</head>
<body>
    <div class="header">
    <h1>REGISTRA TU CITA</h1>
    </div>
    <div class="container">
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">
        </div>
        <div class="form-group">
            <label for="hora">Hora de la cita</label>
            <input type="time" id="hora" name="hora">
        </div>
        <div class="form-group">
            <label for="centro">Centro de donación</label>
            <input type="text" id="centro" name="centro">
        </div>
        <div class="form-group">
            <label>Donar a paciente</label>
            <input type="radio" id="donar_si" name="donar" value="si"> Sí
            <input type="radio" id="donar_no" name="donar" value="no"> No
        </div>
        <div class="form-group">
            <label for="nombre_paciente">Nombre del paciente</label>
            <input type="text" id="nombre_paciente" name="nombre_paciente">
        </div>
        <div class="buttons">
            <a href="cita_menu.php" class="btn btn-danger">CANCELAR</a>
            <a href="" class="btn btn-primary">SIGUIENTE</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>