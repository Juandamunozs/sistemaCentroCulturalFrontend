<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_obra = $_GET['nombre_obra'];
$partitura = $_GET['partitura'];
$ano_creacion = $_GET['ano_creacion'];
$musico = $_GET['musico'];
$genero = $_GET['genero'];
$foto = $_GET['foto'];

try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO obra_famosa (nombre_obra, partitura, ano_creacion, foto, musico, genero) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_obra, $partitura, $ano_creacion, $foto, $musico, $genero]);

    // Verificar si se insertó correctamente
    if ($comando->rowCount() > 0) {
        echo "¡Datos insertados!";
    } else {
        echo "No se pudo insertar";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la inserción
    echo "Error al insertar datos: " . $e->getMessage();
}
?>