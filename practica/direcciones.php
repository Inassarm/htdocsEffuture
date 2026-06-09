<?php
session_start();

// 1. Si no está logueado, lo mandamos al login
if (!isset($_SESSION["personal"]) || !isset($_SESSION["correo"])) {
    header("Location: entrar.html");
    exit();
}

$correo_usuario = $_SESSION["correo"];

// 2. Conexión a la base de datos para buscar si ya tiene dirección
$conexion = new mysqli("10.10.10.160", "clase", "1234", "martes9");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Buscamos si existe una dirección para esta persona uniendo las tablas
$sql = "SELECT d.dir_dir FROM personal p 
        INNER JOIN direcciones d ON p.id_per = d.id_per 
        WHERE p.email_per = '$correo_usuario'";

$resultado = $conexion->query($sql);

// Variable por defecto (vacía por si es la primera vez que entra)
$direccion_actual = "";

if ($resultado->num_rows > 0) {
    foreach ($resultado as $fila) {
        $direccion_actual = $fila["dir_dir"];
    }
}

$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Dirección</title>
</head>
<body>
    <h2>Formulario de Dirección</h2>
    
    <p>Usuario actual: <strong><?php ($_SESSION["personal"]); ?></strong></p>
    
    <form action="guardardireccion.php" method="POST">
        <label for="direccion">Dirección Específica:</label><br>
        
        <input type="text" id="direccion" name="dir_dir" 
               value="<?php ($direccion_actual); ?>" 
               placeholder="Calle, Número, Ciudad, CP..." style="width: 300px;" required><br><br>

        <button type="submit">Registrar Dirección</button>
    </form>
    
    <br>
    <a href="privado.php">Volver al Perfil</a>
</body>
</html>