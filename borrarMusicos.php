<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_musico = $_GET['nombre_musico'];
$fecha_nac = $_GET['fecha_nac'];
$fecha_muerte = $_GET['fecha_muerte'];
$historia_de_vida = $_GET['historia_de_vida'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM musico WHERE nombre_musico = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, borrar los datos
        $sql = "DELETE FROM musico WHERE nombre_musico=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Datos borrados correctamente!";
        } else {
            echo "No se pudo borrar los datos.";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe una época con ese nombre en la base de datos.";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la eliminación
    echo "Error: " . $e->getMessage();
}
?>