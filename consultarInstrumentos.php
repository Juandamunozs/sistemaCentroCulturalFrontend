<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumentos</title>
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
            background-image: url('https://image.slidesdocs.com/responsive-images/background/whimsical-white-with-3d-musical-notes-and-symbols-featuring-curves-and-swirls-powerpoint-background_c062c21ffe__960_540.jpg');
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
<h1 class="title">Información de instrumentos</h1>
    <button id="button1">Regresar</button>
        <script>
            document.getElementById("button1").addEventListener("click", function() {
                window.location.href = "index.html";
            });
        </script>
    <div class="container">
        <?php
        include 'conectar.php';

        try {
            // Obtener registros de la tabla instrumento
            $sql = "SELECT nombre_instrumento, creador, lugar_creacion, tipo, material, genero, foto FROM instrumento";
            $query = $pdo->prepare($sql);
            $query->execute();

            // Obtener todos los resultados como objetos
            $consulta = $query->fetchAll(PDO::FETCH_OBJ);

            // Verificar si hay datos
            if ($query->rowCount() > 0) {
                // Mostrar los datos como cartas
                foreach ($consulta as $registro) {
                    echo '<a href="generoDelInstrumento.php?genero=' . urlencode($registro->genero) . '" class="card">';
                    echo '<div>';
                    echo '<h2>' . $registro->nombre_instrumento . '</h2>';
                    echo '<img src="' . $registro->foto . '" alt="No hay imagen del instrumento" style="width: 250px; height: 200px;">';
                    echo '<p><strong>Creador:</strong> ' . $registro->creador . '</p>';
                    echo '<p><strong>Lugar de creación:</strong> ' . $registro->lugar_creacion . '</p>';
                    echo '<p><strong>Tipo:</strong> ' . $registro->tipo . '</p>';
                    echo '<p><strong>Material:</strong> ' . $registro->material . '</p>';
                    echo '<p><strong>Genero:</strong> ' . $registro->genero . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "No hay datos en la tabla.";
            }
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier excepción de PDO
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
        ?>
    </div>
    <footer>
       
    </footer>
</body>
</html>