<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background:linear-gradient(to bottom right, #5cc2ff, #2196f3);
            margin: 0; /* Elimina el margen predeterminado del body */
            height: 100vh; /* Asegura que el body ocupe toda la altura de la ventana */
            display: flex;
            flex-direction: column; /* Apila los elementos verticalmente */
        }
        .header {
            background-color: #0D92F4;/* Azul más oscuro para la barra superior */
            color: white;
            text-align: center;
            padding: 15px 0;
        }
        .container {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            margin: 20px auto; /* Centra el contenedor y agrega margen superior e inferior */
            flex-grow: 1; /* Permite que el contenedor crezca para ocupar el espacio restante */
            display: flex;
            flex-direction: column; /* Apila el contenido del contenedor verticalmente */
        }
        .question {
            margin-bottom: 15px;
        }
        .question label {
            display: block;
            margin-bottom: 5px;
        }
        .question input[type="radio"] {
            margin-right: 5px;
        }
        .buttons {
            text-align: right;
            margin-top: auto; /* Empuja los botones hacia la parte inferior del contenedor */
        }
        .buttons button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CUESTIONARIO</h1>
    </div>
    <div class="container">
        <p>Para ser un donador apto tiene que llenar el siguiente cuestionario. En caso de no cumplir con los requerimientos no tendrá la posibilidad de donar.</p>

        <div class="question">
            <label>¿Se ha vacunado en el último mes?</label>
            <input type="radio" name="vacuna" value="si"> Sí
            <input type="radio" name="vacuna" value="no"> No
            <label>¿Se ha realizado algún tratamiento dental?</label>
            <input type="radio" name="dental" value="si"> Sí
            <input type="radio" name="dental" value="no"> No
            <label>¿Se ha realizado algún tatuaje en los últimos 12 meses?</label>
            <input type="radio" name="tatuaje" value="si"> Sí
            <input type="radio" name="tatuaje" value="no"> No
            <label>¿Ha presentado algún síntoma de alguna enfermedad estos días?</label>
            <input type="radio" name="sintomas" value="si"> Sí
            <input type="radio" name="sintomas" value="no"> No
            <label>¿Pesas más de 50kg?</label>
            <input type="radio" name="peso" value="si"> Sí
            <input type="radio" name="peso" value="no"> No
            <label>¿Has usado drogas en los últimos 12 meses?</label>
            <input type="radio" name="drogas" value="si"> Sí
            <input type="radio" name="drogas" value="no"> No
            <label>¿Has tomado analgésicos en el último mes?</label>
            <input type="radio" name="analgesicos" value="si"> Sí
            <input type="radio" name="analgesicos" value="no"> No
            <label>¿Consideras que tienes buena salud?</label>
            <input type="radio" name="salud" value="si"> Sí
            <input type="radio" name="salud" value="no"> No
            
        </div>

        <div class="buttons">
            <a href="cita_menu.php" class="btn btn-danger">CANCELAR</a>
            <a href="cita_registro.php" class="btn btn-primary">SIGUIENTE</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>