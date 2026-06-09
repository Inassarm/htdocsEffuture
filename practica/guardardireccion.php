<?php
session_start();

if (!isset($_SESSION["personal"]) || !isset($_SESSION["correo"])) {
    header("Location: entrar.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $direccion = $_POST['dir_dir'];
    $correo_usuario = $_SESSION["correo"];

    $conexion = new mysqli("10.10.10.160", "clase", "1234", "martes9");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // 1. Buscamos el id_per del usuario logueado
    $sql_usuario = "SELECT id_per FROM personal WHERE email_per = '$correo_usuario'";
    $resultado_usuario = $conexion->query($sql_usuario);

    if ($resultado_usuario->num_rows > 0) {
        
        foreach ($resultado_usuario as $fila_u) {
            $id_persona = $fila_u["id_per"];
        }

        // 2. Revisamos si ya tiene dirección
        $sql_check = "SELECT * FROM direcciones WHERE id_per = '$id_persona'";
        $resultado_check = $conexion->query($sql_check);

        if ($resultado_check->num_rows > 0) {
            $sql_final = "UPDATE direcciones SET dir_dir = '$direccion' WHERE id_per = '$id_persona'";
        } else {
            $sql_final = "INSERT INTO direcciones (id_per, dir_dir) VALUES ('$id_persona', '$direccion')";
        }

        // 3. Ejecutamos la consulta
        if ($conexion->query($sql_final)) {
            echo "<br><b style='color:green;'>Dirección guardada correctamente. <a href='privado.php'>Volver al Perfil</a></b>";
        } else {
            echo "<br>Error al guardar: " . $conexion->error;
        }

    } else {
        echo "<br>Error: Usuario no encontrado.";
    }

    $conexion->close();

} else {
    header("Location: direccion.php");
    exit();
}
?>