<?php
    if($_POST)
    {
        $ema = $_POST['correo'];
        $pas = $_POST['contra'];
        
        include("conexion.php");
        
        // Adaptado a tu columna 'email' en lugar de 'email_per'
        $sql = "SELECT * FROM personas WHERE email = '$ema'";
        $res = $con->query($sql);
        
        if($res->num_rows != 0 )
        {
            // Encontré email
            foreach($res as $fil)
            {
                // Adaptado a tus columnas exactas: 'id_per' y 'password'
                $id = $fil["id_per"];
                $pasbd = $fil["password"]; 
                
                if(password_verify($pas, $pasbd))
                {
                    // Coinciden
                    session_start();
                    $_SESSION['persona'] = $id;
                    header("location:index.php");
                    exit(); // Buena práctica para detener la ejecución tras redireccionar
                }
                else
                {
                    echo "<center style='color: red; margin-top: 10px;'>Contraseña incorrecta</center>";
                }
            }
        }
        else
        {
            echo "<center style='color: red; margin-top: 10px;'>El correo no está registrado</center>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
    <center>
    <?php
        include("menu.php");
        pinta_menunolog();
    ?>
    <h1>Login</h1>
    <span>Introduce tus datos</span>
    <form method="POST">
        <input type="email" name="correo" placeholder="Email" required>
        <br><br>
        <input type="password" name="contra" placeholder="Contraseña" required>
        <br><br>
        <input type="submit" value="Entrar">
    </form>
</center>
</body>
</html>