<?php
// 1. Iniciamos sesión para poder manipularla
session_start();

// 2. Destruimos todas las variables de la sesión
session_destroy();

// 3. Redireccionar
header("Location: index.php");
exit(); 
?>