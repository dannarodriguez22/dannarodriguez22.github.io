<?php
include 'conexion.php';
include 'estilos.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['correo']);
    $pass = md5($_POST['contraseña']);

    $select = " SELECT * FROM usuario WHERE contraseña = '$pass'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_array($result);
        
        if ($row['correo'] == $email) {
            header('location:productos.php');
        }else{
            header("location: iniciar_sesion.php?mensaje= La contraseña o correo no coincide ");
         
        };
    }else{
        header("location: iniciar_sesion.php?mensaje= La contraseña o correo no coincide ");
     
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio_sesion</title>
</head>
<body>
<div class="form-container">
    <form action="iniciar_sesion.php" method="post">
    <?php
            if(isset($_GET["mensaje"])){
                echo "<h2 class='message'>". $_GET["mensaje"] ."</h2>";
                }
            ?>
        <h3>Iniciar sesion</h3>
        <input type="text" name="correo" required placeholder="Correo">
        <input type="password" name="contraseña" required placeholder="Contraseña">
        <input type="submit" name="submit" value="Iniciar sesion" class="form-btn">
        <p>¿No tienes una cuenta? <a href="registro.php">Crear cuenta</a></p>



</div>
</body>
</html>