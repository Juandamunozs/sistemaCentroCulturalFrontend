<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_instrumento = $_GET['nombre_instrumento'];
$creador = $_GET['creador'];
$lugar_creacion = $_GET['lugar_creacion'];
$tipo = $_GET['tipo'];
$material = $_GET['material'];
$foto = $_GET['foto'];
try {
    // Preparar la instrucción de inserción
    $sql = "INSERT INTO instrumento (nombre_instrumento, creador, lugar_creacion, tipo, material, foto) VALUES (?, ?, ?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    
    // Ejecutar la instrucción de inserción
    $comando->execute([$nombre_instrumento, $creador, $lugar_creacion, $tipo, $material, $foto]);

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