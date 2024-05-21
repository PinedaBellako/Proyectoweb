<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(255, 253, 208, 0.5), rgba(255, 253, 208, 0.5)), url('https://via.placeholder.com/1500x1000') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            color: #ffffff; /* Letras en blanco */
            padding-top: 40px; /* Ajuste para centrar el formulario */
        }
        .container {
            width: 50%;
            margin: 0 auto;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fondo semi-transparente */
            padding: 20px;
            border-radius: 10px;
        }
        .btn {
            background-color: #ff6f00 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Establecer conexión a la base de datos
        $user_db = "if0_36589081";
        $pass_db = "SzeTLWt6XLL3sW";
        $db_name = "if0_36589081_db_proyecto";
        $host_db = "sql111.infinityfree.com";
        $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

        if ($conexion->connect_error) {
            die("La conexión falló: " . $conexion->connect_error);
        } 

        // Procesar datos del formulario
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

        // Insertar datos en la base de datos
        $insertarusuario = "INSERT INTO user (nombre, edad, email, telefono) VALUES (?, ?, ?, ?)";
        if ($stmt = $conexion->prepare($insertarusuario)) {
            $stmt->bind_param("ssss", $nombre, $edad, $email, $telefono);
            if ($stmt->execute()) {
                echo "<h1 class='center-align'>Usuario registrado con éxito</h1>";
                // Botón para agregar otro registro
                echo "<div class='center-align'>";
                echo "<form action='formulario2.html'>";
                echo "<button class='btn' type='submit'>Agregar Otro Registro</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<h2 class='center-align'>Error al registrar el usuario: " . $stmt->error . "</h2>";
            }
            $stmt->close();
        } else {
            echo "<h2 class='center-align'>Error en la preparación de la declaración: " . $conexion->error . "</h2>";
        }

        $conexion->close();
        ?>
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
