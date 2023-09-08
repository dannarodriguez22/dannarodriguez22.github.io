<?php
include 'conexion.php';
include 'estilos.php';

?>


<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body class="cuadro-producto">
    <header>
        <form action="buscador.php"  method="POST">
            <div class="header">
                <input class="buscador" type="search" name="buscador" id="search-box" placeholder="Buscar producto...">
                <input type="submit" id="buscar" name="buscar" hidden>
                <a href=""><img class="imagen" src="logo-frutiland.png"></a>
               <!-- Formulario para cerrar sesión -->
            </div>
        </form>
        
    </header>
    <div class="contenedor">
        <section>
            
                <a href="fruta.php"><input type="submit" name="fruta" value="Fruta" class="boton-fruta-verdura" ></a>
                <a href="verdura.php"><input type="submit" name="verdura" value="Verdura" class="boton-fruta-verdura" ></a>
                <a href="añadir_producto.php"><input type="submit" name="añadir_producto" value="Añadir producto" class="boton-fruta-verdura" ></a>
                <a href="cerrar_sesion.php" ><input type="submit" name="cerrar_sesion" value="Cerrar sesion" class="boton-fruta-verdura"></a>
            <?php
                //Realizar consulta
                $sql = "SELECT id_producto, nombre_producto, precio FROM producto";
                $result = $conn->query($sql);

                //Organizar productos por fila
                $productos_por_fila = 7;
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
                    
                        echo '<h2 >' . $fila['nombre_producto'] . ' </h2>';
                        echo '<h3>' .$fila['precio'] . '</h3>';
                        ?>
                        <input type="number" class="barrita" name="tentacles" min="1" max="1000"/><br><br>
                        <a href=""><input type="submit" name="submit" value="Comprar" class="boton" id="botom"></a>
                
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
        </section>

    </div>
</body>
</html>