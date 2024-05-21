<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Usuarios</title>
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
            padding-top: 40px; /* Ajuste para centrar la tabla */
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .table-container {
            background-color: rgba(0, 0, 0, 0.7); /* Fondo semi-transparente */
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto; /* Hacer scroll horizontal si es necesario */
        }
        .btn {
            background-color: #ff6f00 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Conexión a la base de datos
        $user_db = "if0_36589081";
        $pass_db = "SzeTLWt6XLL3sW";
        $db_name = "if0_36589081_db_proyecto";
        $host_db = "sql111.infinityfree.com";
        $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

        if ($conexion->connect_error) {
            die("La conexión falló: " . $conexion->connect_error);
        } 

        // Función para eliminar un registro por su ID
        if(isset($_POST['eliminar'])){
            $id_eliminar = $_POST['eliminar'];
            $eliminar_sql = "DELETE FROM user WHERE id = $id_eliminar";
            if ($conexion->query($eliminar_sql) === TRUE) {
                echo "<p>Registro eliminado correctamente.</p>";
            } else {
                echo "Error al eliminar el registro: " . $conexion->error;
            }
        }

        // Consulta SQL para obtener todos los registros de la tabla user
        $sql = "SELECT * FROM user";
        $resultado = $conexion->query($sql);

        // Comprobar si hay registros
        if ($resultado->num_rows > 0) {
            // Mostrar los registros en una tabla HTML
            echo "<h2 class='center-align'>Registros de Usuarios</h2>";
            echo "<div class='table-container'>";
            echo "<table class='striped centered'>";
            echo "<thead><tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Email</th><th>Teléfono</th><th>Acciones</th></tr></thead>";
            echo "<tbody>";
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$fila['id']."</td>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['edad']."</td>";
                echo "<td>".$fila['email']."</td>";
                echo "<td>".$fila['telefono']."</td>";
                echo "<td>
                        <form method='post'>
                            <button class='btn red' type='submit' name='eliminar' value='".$fila['id']."'>Eliminar</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            
            // Botón de actualizar fuera de la tabla
            echo "<div class='center-align'>";
            echo "<form action='update.html' method='POST'>";
            echo "<button class='btn' type='submit'>Actualizar</button>";
            echo "</form>";
            echo "</div>";

            // Botón para agregar otro registro
            echo "<div class='center-align'>";
            echo "<form action='formulario2.html'>";
            echo "<button class='btn' type='submit'>Agregar Otro Registro</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>No se encontraron registros.</p>";
        }

        $conexion->close();
        ?>
    </div>

    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
