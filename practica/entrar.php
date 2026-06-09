<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recibimos los datos limpios
    $ema = $_POST['correo'];
    $contra = $_POST['contra'];

    // Conexión a la base de datos
    $conexion = new mysqli("10.10.10.160", "clase", "1234", "martes9");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // 2. Buscamos el correo
    $sql = "SELECT * FROM personal WHERE email_per = '$ema'";
    $resultado = $conexion->query($sql);

    // vamos a ver si hay más de una coincidencia
    if ($resultado->num_rows > 0) {

      
        foreach ($resultado as $fila) {
            $id = $fila["id_per"];
            $nom = $fila["nom_per"];
            $contraBD = $fila["pass_per"]; 

            // 3. Verificamos la contraseña encriptada
            if (password_verify($contra, $contraBD)) {
                
                $_SESSION["personal"] = $nom; 
                $_SESSION["correo"] = $ema; 

                $conexion->close();
                header("Location: privado.php");
                exit();
            } else {
                echo "CONTRASEÑA INCORRECTA";
            }
        }
    } else {
        echo "EMAIL INCORRECTO";
    }

    $conexion->close();

} else {
    echo "Por favor, inicia sesión desde el formulario.";
}
?>