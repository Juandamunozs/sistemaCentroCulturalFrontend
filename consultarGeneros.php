<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Géneros</title>
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
        text-decoration: none; /* Quitar subrayado predeterminado para el enlace */
    }

    .card:hover {
         filter: brightness(1.2);
         transform: scale(1.01);
         border: 1px solid #6e29c9;
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
            background-image: url('https://www.vozviva.es/wp-content/uploads/2012/09/tipos-de-musica.jpg');
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-repeat: no-repeat; /* Evita que la imagen de fondo se repita */
            background-attachment: fixed; /* Fija la imagen de fondo para que no se desplace con el contenido */
        }
    /* .container {
            text-align: center;
            white-space: nowrap; // Evita que las cartas se envuelvan 
            overflow-x: auto; // Agrega desplazamiento horizontal si las cartas no caben en la pantalla 
        }*/
</style>
</head>
<body>
    <h1 class="title">Información de género</h1>
    <button id="button1">Regresar</button>
    <div class="container">
        <?php
        include 'conectar.php';

        try {
            // Obtener registros de la tabla género
            $sql = "SELECT nombre_genero, caracteristica_g, origen, foto, instrumento FROM genero";
            $query = $pdo->prepare($sql);
            $query->execute();

            // Obtener todos los resultados como objetos
            $consulta = $query->fetchAll(PDO::FETCH_OBJ);

            // Verificar si hay datos
            if ($query->rowCount() > 0) {
                // Mostrar los datos como cartas
                foreach ($consulta as $registro) {
                    echo '<a href="generoAtodo.php?dato=' . urlencode($registro->origen. ',' . $registro->instrumento. ',' . $registro->nombre_genero) . '" class="card">';
                    echo '<div>';
                    echo '<h2>' . $registro->nombre_genero . '</h2>';
                    echo '<img src="' . $registro->foto . '" alt="No hay imagen del género" style="width: 250px; height: 200px;">';
                    echo '<p><strong>Característica:</strong> ' . $registro->caracteristica_g . '</p>';
                    echo '<p><strong>Origen:</strong> ' . $registro->origen . '</p>';
                    echo '<p><strong>Instrumentos:</strong> ' . $registro->instrumento . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "No hay datos del genero.";
            }
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier excepción de PDO
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
        ?>
    </div>
    <footer>
       
    </footer>
    <script>
        document.getElementById("button1").addEventListener("click", function() {
            window.location.href = "index.html";
        });
    </script>
</body>