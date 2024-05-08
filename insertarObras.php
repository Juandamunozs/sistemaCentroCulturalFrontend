<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_obra = $_GET['nombre_obra'];
$partitura = $_GET['partitura'];
$ano_creacion = $_GET['ano_creacion'];

try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO obra_famosa (nombre_obra, partitura, ano_creacion) VALUES (?, ?, ?)";
    $comando = $pdo->prepare($sql);
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_obra, $partitura, $ano_creacion]);

    // Verificar si se insertó correctamente
    if ($comando->rowCount() > 0) {
        echo "¡Datos insertados correctamente!";
    } else {
        echo "No se pudo insertar los datos.";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la inserción
    echo "Error al insertar datos: " . $e->getMessage();
}
?>