<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_musico = $_GET['nombre_musico'];
$fecha_nac = $_GET['fecha_nac'];
$fecha_muerte = $_GET['fecha_muerte'];
$historia_de_vida = $_GET['historia_de_vida'];
$foto = $_GET['foto'];
$genero = $_GET['genero'];


try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO musico (nombre_musico, fecha_nac, fecha_muerte, historia_de_vida, foto, genero) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_musico, $fecha_nac, $fecha_muerte, $historia_de_vida, $foto, $genero]);

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
