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