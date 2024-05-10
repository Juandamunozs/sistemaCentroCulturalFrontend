<?php
include 'conectar.php';

// Recibir los datos del formulario GET
$nombre_instrumento = $_GET['nombre_instrumento'];
$creador = $_GET['creador'];
$lugar_creacion = $_GET['lugar_creacion'];
$tipo = $_GET['tipo'];
$material = $_GET['material'];
$tipo = $_GET['foto'];
$nombreBorrarActualizar = $_GET['nombreBorrarActualizar'];

try {
    // Verificar si el nombre de la época existe en la base de datos
    $consulta_existencia = "SELECT COUNT(*) AS total FROM instrumento WHERE nombre_instrumento = ?";
    $stmt = $pdo->prepare($consulta_existencia);
    $stmt->execute([$nombreBorrarActualizar]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['total'] > 0) {
        // El nombre de la época existe, por lo tanto, borrar los datos
        $sql = "DELETE FROM instrumento WHERE nombre_instrumento=?";
        $comando = $pdo->prepare($sql);
        $comando->execute([$nombreBorrarActualizar]);
        
        if ($comando->rowCount() > 0) {
            echo "¡Datos borrados correctamente!";
        } else {
            echo "No se pudo borrar los datos.";
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