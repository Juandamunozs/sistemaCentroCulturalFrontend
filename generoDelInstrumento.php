<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Géneros musicales</title>
    <link rel="stylesheet" href="style.css"> <!-- Incluye tu archivo CSS externo -->
    <style>
        /* Estilos para las cartas */
        .card {
            border: 1px solid purple; /* Borde morado */
            border-radius: 30px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #6A5ACD; /* Fondo entre azul y morado */
            color: white; /* Texto blanco */
            transition: box-shadow 0.3s ease; /* Transición suave */
        }

        .card h2 {
            margin-top: 0;
            text-align: center; /* Centrar el texto */
        }

        .card p {
            margin-bottom: 5px;
            text-align: left; /* Alinear a la izquierda */
            margin-left: 10px; /* Añadir margen izquierdo para la información */
        }

        .card img {
            display: block; /* Asegura que la imagen ocupe todo el ancho disponible */
            margin: 0 auto; /* Centra la imagen horizontalmente */
            border-radius: 10px; /* Añade un borde redondeado a la imagen */
            max-width: 100%; /* Ajusta el tamaño máximo de la imagen */
            height: auto; /* Mantiene la proporción de aspecto de la imagen */
        }

        /* Cambiar el color del borde y hacer que brille al pasar el mouse */
        .card:hover {
         filter: brightness(1.2);
         transform: scale(1.01);
         border: 1px solid #6e29c9;
    }

        /* Estilos para el fondo del HTML */
        .title {
         text-align: center; /* Centra el texto */
         color: #000000; /* Color negro para el texto */
         background-color: #ffffff; /* Fondo blanco */
         padding: 10px; /* Añade espacio alrededor del texto */
         border-radius: 30px; /* Añade bordes redondeados */
         border: 1px solid #007bff; /* Agrega borde azul */
         margin: 20px; /* Añade margen */
}

        /* Establecer imagen de fondo */
        body {
            background-image: url('https://i.pinimg.com/736x/7d/16/f0/7d16f0f675d7a3edddcf063fb1e7fbf4.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-repeat: no-repeat; /* Evita que la imagen de fondo se repita */
            background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
        }
    </style>
</head>
<body>
    <h1 class="title">Géneros Musicales</h1>
    <button id="button2">Regresar</button>
    <div class="container">
        <?php
        include 'conectar.php';

        // Obtener el parámetro de la URL (género)
        $genero = $_GET['genero'];

        try {
            // Consulta para obtener los géneros coincidentes
            $sql = "SELECT nombre_genero, caracteristica_g, origen, foto, instrumento FROM genero WHERE nombre_genero = :genero";
            $query = $pdo->prepare($sql);
            $query->bindParam(':genero', $genero);
            $query->execute();

            // Obtener todos los resultados como objetos
            $consulta = $query->fetchAll(PDO::FETCH_OBJ);

            // Verificar si hay datos
            if ($query->rowCount() > 0) {
                // Mostrar los datos como cartas
                foreach ($consulta as $registro) {
                    echo '<div class="card">';
                    echo '<h2>' . $registro->nombre_genero . '</h2>';
                    echo '<img src="' . $registro->foto . '" alt="No hay imagen del género" style="width: 250px; height: 200px;">';
                    echo '<p><strong>Característica:</strong> ' . $registro->caracteristica_g . '</p>';
                    echo '<p><strong>Origen:</strong> ' . $registro->origen . '</p>';
                    echo '<p><strong>Instrumento:</strong> ' . $registro->instrumento . '</p>';
                    echo '</div>';
                }
            } else {
                echo "No hay datos en la tabla para el género seleccionado.";
            }
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier excepción de PDO
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
        ?>
    </div>
    <script>
        document.getElementById("button2").addEventListener("click", function() {
            window.history.back();
        });
    </script>
</body>
</html>