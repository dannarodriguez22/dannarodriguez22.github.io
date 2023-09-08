<?php
include 'conexion.php';
include_once 'estilos.php';


if(isset($_POST['submit'])){

//**** PARA CARGAR EL ARCHIVO DE IMAGEN ******************/

    $nombre_producto = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $precio = mysqli_real_escape_string($conn, $_POST['precio']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

    $select = "SELECT * FROM producto WHERE nombre_producto = '$nombre_producto'";

    $result = mysqli_query($conn, $select);
    

    if(mysqli_num_rows($result) > 0){
        echo "El producto ya existe!";
    }else{
        $insert = "INSERT INTO producto(nombre_producto, precio, id_categoria) VALUES ('$nombre_producto','$precio','$categoria')";
        mysqli_query($conn, $insert);
        //header('location: registro.php');
        //exit();  
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir_producto</title>
</head>
<body>
    <div class="form-container">
        <form action="añadir_producto.php" method="post" enctype="multipart/form-data">
            <label class="titulo">Nombre producto:</label><br><br>
            <input type="text" name="nombre_producto" placeholder="Nombre" required><br><br>
            <label class="titulo">Precio: </label><br><br>
            <input type="text" name="precio" placeholder="Precio" required><br><br>
            <label class="titulo">Categoria</label><br><br>
            <select class="barra" name="categoria" required>
                <option value="seleccione">Seleccione</option><br><br>
                <option value="1">Fruta</option><br><br>
                <option value="2">Verdura</option>
            </select><br><br>
            <input class="form-btn" type="submit" name="submit" value="Añadir producto">
            <p> <a href="productos.php">Productos</a></p>
        </form>
    </div>
</body>
</html>
