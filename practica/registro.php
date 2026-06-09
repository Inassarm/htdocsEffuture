<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom      = $_POST["nom_per"] ?? '';
    $ema      = $_POST["email_per"] ?? '';     
    $password = $_POST["pass_per"] ?? '';   

    $contra = password_hash($password, PASSWORD_DEFAULT);

    $conexion = new mysqli("10.10.10.160", "clase", "1234", "martes9");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO personal (nom_per, email_per, pass_per) VALUES ('$nom', '$ema', '$contra')";

    if ($conexion->query($sql)) {
        $_SESSION["personal"] = $nom;
        $_SESSION["correo"] = $ema; 

        echo "<br><b style='color:green;'>Persona registrada correctamente. <a href='privado.php'>Ir a mi Perfil</a></b>";
    } else {
        echo "<br>Error en la base de datos: " . $conexion->error;
    }

    $conexion->close();
}
?>
