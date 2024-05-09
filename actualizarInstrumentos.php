<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_instrumento = $_GET['nombre_instrumento'];
$creador = $_GET['creador'];
$lugar_creacion = $_GET['lugar_creacion'];
$tipo = $_GET['tipo'];
$material = $_GET['material'];
$foto = $_GET['foto'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM instrumento WHERE nombre_instrumento = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, actualiza los datos
        $sql = "UPDATE instrumento SET nombre_instrumento=?, creador=?, lugar_creacion=?, tipo=?, material=?, foto=? WHERE nombre_instrumento=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombre_instrumento, $creador, $lugar_creacion, $tipo, $material, $foto, $nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Datos actualizados correctamente!";
        } else {
            echo "No se pudo actualizar los datos.";
        }
    } else {
        // El nombre de la época no existe, mostrar mensaje de error
        echo "No existe una época con ese nombre en la base de datos.";
    }
} catch (PDOException $e) {
    // Manejo de errores en caso de que falle la consulta o la actualización
    echo "Error: " . $e->getMessage();
}
?>