<?php
include 'conexion.php';
include 'estilos.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['correo']);
    $pass = md5($_POST['contraseña']);
    $cpass = md5($_POST['cpassword']);

    $select = " SELECT * FROM usuario WHERE correo = '$email'";

    $result = mysqli_query($conn, $select);
    
    
    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist!';
        echo "El usuario ya existe!";
    }else{
        
        if($pass != $cpass){
            $error[] = 'password not matched!';
            header("location: registro.php?mensaje= La contraseña no coincide");
        }else{
            $insert = "INSERT INTO usuario(nombre, correo, contraseña) VALUES('$name','$email','$pass')";
            mysqli_query($conn, $insert);
            header('location:iniciar_sesion.php');
        };
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro</title>
</head>
    <div class="form-container">
       
        <form action="registro.php" method="post">
            <h3>Crear cuenta</h3>
            <?php
            if(isset($_GET["mensaje"])){
                echo "<h2 class='message'>". $_GET["mensaje"] ."</h2><br>";
                }
            ?>
            <input type="text" name="nombre" required placeholder="Nombre">
            <input type="text" name="correo" required placeholder="Correo">
            <input type="password" name="contraseña" required placeholder="Contraseña">
            <input type="password" name="cpassword" required placeholder="Confirmar contraseña">
            <input type="submit" name="submit" value="Registrarse" class="form-btn">
            <p>Ya tienes una cuenta? <a href="iniciar_sesion.php">Iniciar sesion</a></p>

        </form>
    </div>
</body>
</html> 