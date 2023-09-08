<?php
include 'conexion.php';
include 'estilos.php';
    $con = $conn;
    $id = $_POST['buscador'];
    $query = "SELECT id_producto, nombre_producto, precio FROM producto WHERE nombre_producto LIKE ?";

    $stmt = $con->prepare($query);
    $param = "%$id%";
    $stmt->bind_param('s', $param);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Almacena todos los registros
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if (isset($rows) && !empty($rows)) {
        foreach ($rows as $row) {
            ?>
            <div class="producto">
            <?php
            echo '<h3>' . $row['id_producto'] . '</h3><br>';
            echo '<h3>' . $row['nombre_producto'] . '</h3><br>';
            echo '<h3>' . $row['precio'] . '</h3>';
            ?>
            </div>
            <?php
        }
    } else {
        echo "No se encontró ningún producto con '$id'";
    }
?>