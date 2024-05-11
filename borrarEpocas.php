<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_epoca = $_GET['nombre_epoca'];
$caracteristica_e = $_GET['caracteristica_e'];
$comienzo = $_GET['comienzo'];
$final = $_GET['final'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM epoca WHERE nombre_epoca = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, borrar los datos
        $sql = "DELETE FROM epoca WHERE nombre_epoca=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Datos borrados!";
        } else {
            echo "No se pudo borrar";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe esa epoca";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la eliminación
    echo "Error: " . $e->getMessage();
}
?>