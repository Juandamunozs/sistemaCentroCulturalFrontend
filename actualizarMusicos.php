<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_musico = $_GET['nombre_musico'];
$fecha_nac = $_GET['fecha_nac'];
$fecha_muerte = $_GET['fecha_muerte'];
$historia_de_vida = $_GET['historia_de_vida'];
$foto = $_GET['foto'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM musico WHERE nombre_musico = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, actualiza los datos
        $sql = "UPDATE musico SET nombre_musico=?, fecha_nac=?, fecha_muerte=?, historia_de_vida=?, foto=? WHERE nombre_musico=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombre_musico, $fecha_nac, $fecha_muerte, $historia_de_vida, $foto,  $nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Actualizado!";
        } else {
            echo "No se pudo actualizar";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe ese musico";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la actualización
    echo "Error: " . $e->getMessage();
}
?>