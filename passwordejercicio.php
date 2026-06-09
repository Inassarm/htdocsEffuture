<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom      = $_POST["nom_cli"] ?? '';
    $ema      = $_POST["email_cli"] ?? '';     
    $password = $_POST["password_cli"] ?? '';   

    // Codificamos el email (y el nombre si así lo requieres, pero ojo al mostrarlo)
    $nome = base64_encode($nom); 
    $ema_codificado = base64_encode($ema);
    
    // Hash seguro para la contraseña
    $contra = password_hash($password, PASSWORD_DEFAULT);

    $conexion = new mysqli("localhost", "root", "", "lunes_8");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO clientes (nom_cli, email_cli, password_cli) VALUES ('$nome', '$ema_codificado', '$contra')";

    if ($conexion->query($sql)) {
        echo "<br><b style='color:green;'>Usuario registrado correctamente. <a href='login.php'>Ir al Login</a></b>";
    } else {
        echo "<br>Error en la base de datos: " . $conexion->error;
    }

    $conexion->close();
}
?>