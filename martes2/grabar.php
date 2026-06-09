<?php

// Recoger datos
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$email = $_POST["email"];
$password = $_POST["password"];
$provincia = $_POST["provincia"];
$nacimiento = $_POST["nacimiento"];
$cp = $_POST["cp"];

// Conexión a la BD
$conexion = new mysqli("10.10.10.160", "clase", "1234", "martes2");


// SQL para grabar
$sql = "INSERT INTO clientes
(nombre, apellidos, email, password, provincia, nacimiento, cp)
VALUES
('$nombre', '$apellidos', '$email', '$password', '$provincia', '$nacimiento', '$cp')";

// Ejecutar
if ($conexion->query($sql)) {
    echo "Usuario grabado correctamente";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();

?>