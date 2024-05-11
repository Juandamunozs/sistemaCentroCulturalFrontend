<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_genero = $_GET['nombre_genero'];
$caracteristica_g = $_GET['caracteristica_g'];
$origen = $_GET['origen'];
$foto = $_GET['foto'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM genero WHERE nombre_genero = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, actualiza los datos
        $sql = "UPDATE genero SET nombre_genero=?, caracteristica_g=?, origen=?, foto=? WHERE nombre_genero=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombre_genero, $caracteristica_g, $origen, $foto, $nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Actualizado!";
        } else {
            echo "No se pudo actualizar";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe ese genero";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la actualización
    echo "Error: " . $e->getMessage();
}
?>