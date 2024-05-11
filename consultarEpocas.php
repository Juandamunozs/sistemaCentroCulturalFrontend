<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epoca</title>
    <link rel="stylesheet" href="style.css"> <!-- Incluye tu archivo CSS externo -->
</head>
<body>
    <h1>Épocas Registradas en el Centro Cultural</h1>
    <div class="container">
        <?php
        include 'conectar.php';

        try {
            // Obtener registros de la tabla epoca
            $sql = "SELECT nombre_epoca, caracteristica_e, comienzo, final FROM epoca";
            $query = $pdo->prepare($sql);
            $query->execute();

            // Obtener todos los resultados como objetos
            $consulta = $query->fetchAll(PDO::FETCH_OBJ);

            // Verificar si hay datos
            if ($query->rowCount() > 0) {
                // Mostrar los datos en forma de tabla
                echo '<table>';
                echo '<tr><th>Nombre Época</th><th>Característica</th><th>Inicio</th><th>Fin</th></tr>';
                foreach ($consulta as $registro) {
                    echo '<tr>';
                    echo '<td>' . $registro->nombre_epoca . '</td>';
                    echo '<td>' . $registro->caracteristica_e . '</td>';
                    echo '<td>' . $registro->comienzo . '</td>';
                    echo '<td>' . $registro->final . '</td>';
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