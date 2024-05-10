<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_obra = $_GET['nombre_obra'];
$partitura = $_GET['partitura'];
$ano_creacion = $_GET['ano_creacion'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM obra_famosa WHERE nombre_obra = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, actualiza los datos
        $sql = "UPDATE obra_famosa SET nombre_obra=?, partitura=?, ano_creacion=? WHERE nombre_obra=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombre_obra, $partitura, $ano_creacion, $nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Actualizado correctamente!";
        } else {
            echo "No se pudo actualizar";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe esa epoca";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la actualización
    echo "Error: " . $e->getMessage();
}
?>