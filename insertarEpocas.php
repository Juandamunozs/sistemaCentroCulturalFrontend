<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_epoca = $_GET['nombre_epoca'];
$caracteristica_e = $_GET['caracteristica_e'];
$comienzo = $_GET['comienzo'];
$final = $_GET['final'];
$foto = $_GET['foto'];
try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO epoca (nombre_epoca, caracteristica_e, comienzo, final, foto) VALUES (?, ?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_epoca, $caracteristica_e, $comienzo, $final, $foto]);

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
