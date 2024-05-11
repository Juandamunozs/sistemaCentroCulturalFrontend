<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_genero = $_GET['nombre_genero'];
$caracteristica_g = $_GET['caracteristica_g'];
$origen = $_GET['origen'];
$foto = $_GET['foto'];

try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO genero (nombre_genero, caracteristica_g, origen, foto) VALUES (?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_genero, $caracteristica_g, $origen, $foto]);

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