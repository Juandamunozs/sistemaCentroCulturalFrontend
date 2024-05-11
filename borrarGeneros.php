<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_genero = $_GET['nombre_genero'];
$caracteristica_g = $_GET['caracteristica_g'];
$origen = $_GET['origen'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM genero WHERE nombre_genero = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, borrar los datos
        $sql = "DELETE FROM genero WHERE nombre_genero=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Datos borrados!";
        } else {
            echo "No se pudo borrar";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe ese genero";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la eliminación
    echo "Error: " . $e->getMessage();
}
?>