<?php  
include 'conexion.php';
include 'estilos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruta</title>
</head>
<body>
<header>
        <form action="buscador.php"  method="POST">
            <div class="header">
                <input class="buscador" type="search" name="buscador" id="search-box" placeholder="Buscar fruta...">
                <input type="submit" id="buscar" name="buscar" hidden>
                <a href=""><img class="imagen" src="logo-frutiland.png"></a>
             </div>
        </form>
    </header>

<?php

         //Realizar consulta
                $sql = "SELECT id_producto, nombre_producto, precio FROM producto WHERE id_categoria = 1";
                $result = $conn->query($sql);

                //Organizar productos por fila
                $productos_por_fila = 5;
                $contador_productos = 0;

                //Mostrar productos
                while ($fila =$result->fetch_assoc()) {
                // Si el contador llega al número de productos por fila, cerrar la fila y comenzar una nueva
                if ($contador_productos % $productos_por_fila === 0) {
                echo '<div class="fila-producto">';
                }
                ?>
                <!-- Mostrar el producto actual -->
                <div class="producto">
                    <?php
                        echo '<h2 >' . $fila['nombre_producto'] . '</h2>';
                        echo '<h3>' .$fila['precio'] . '</h3>';
                        ?>
                        <input type="number" class="barrita" name="tentacles" min="1" max="1000"/><br><br>
                        <input type="submit" name="submit" value="Comprar" class="boton" ><br>
                    </div>
                    
                    <?php
                // Incrementar el contador de productos
                $contador_productos++;
                
                // Si llegamos al final de una fila, cerramos la fila
                
                if ($contador_productos % $productos_por_fila === 0) {
                    echo '</div>'; // Cerramos la fila
                }
            }
            
            // Si hay productos que no llenen una fila completa, cerramos la última fila
            
            if ($contador_productos % $productos_por_fila !== 0) {
                echo '</div>'; // Cerrar la última fila
            }
            ?>
            <p> <a href="productos.php">Productos</a></p>
</body>
</html>