<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos de Época</title>
    <link rel="stylesheet" href="style.css"> <!-- Incluye tu archivo CSS externo -->
</head>
<body>
    <h1>Instrumentos Registrados en el Centro Cultural</h1>
    <div class="container">
        <?php
        include 'conectar.php';

        try {
            // Obtener registros de la tabla instrumento
            $sql = "SELECT nombre_instrumento, creador, lugar_creacion, tipo, material, foto FROM instrumento";
            $query = $pdo->prepare($sql);
            $query->execute();

            // Obtener todos los resultados como objetos
            $consulta = $query->fetchAll(PDO::FETCH_OBJ);

            // Verificar si hay datos
            if ($query->rowCount() > 0) {
                // Mostrar los datos en forma de tabla
                echo '<table>';
                echo '<tr><th>Nombre Instrumento</th><th>Creador</th><th>Lugar de creación</th><th>Tipo</th><th>Material</th><th>Foto</th></tr>';
                foreach ($consulta as $registro) {
                    echo '<tr>';
                    echo '<td>' . $registro->nombre_instrumento . '</td>';
                    echo '<td>' . $registro->creador . '</td>';
                    echo '<td>' . $registro->lugar_creacion . '</td>';
                    echo '<td>' . $registro->tipo . '</td>';
                    echo '<td>' . $registro->material . '</td>';
                    // Mostrar la imagen utilizando la etiqueta <img>
                    echo '<td><img src="' . $registro->foto . '" alt="Foto del instrumento" width="100"></td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "No hay datos en la tabla.";
            }
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier excepción de PDO
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
        ?>
    </div>
</body>
<footer>
    <button id="button1">Regresar</button>
    <script>
        document.getElementById("button1").addEventListener("click", function() {
            window.location.href = "index.html";
        });
    </script>
</footer>
</html>