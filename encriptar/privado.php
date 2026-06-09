<?php
// 1. Iniciamos la sesión siempre al principio
session_start();

// 2. Comprobamos si la variable de sesión "clientes" existe y no es nula
if (isset($_SESSION["clientes"])) {
    $nom = $_SESSION["clientes"];
    echo "Hola $nom";
} else {
    // 3. Si la sesión no está creada, te mando al login
    header("Location: login.html");
    exit(); // Es muy importante poner exit() para detener la ejecución del script aquí
}
?>