<?php
// Iniciamos la sesión para comprobar si el usuario está logueado o no
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Sistema</title>
</head>
<body>

<nav class="navbar">
    <div class="nav-logo">Mi Sistema</div>
    <ul class="nav-links">
        <?php
        // SI existe la sesión (El usuario está logueado)
        if (isset($_SESSION["personal"])) { 
        ?>
            <li class="nav-welcome"><?php($_SESSION["personal"]); ?></li>
            <li><a href="privado.php">Mi Perfil</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        <?php 
        } else { 
        ?>
            <li><a href="registro.html">Registrarse</a></li>
            <li><a href="entrar.html">Iniciar Sesión</a></li>
        <?php 
        } 
        ?>
    </ul>
</nav>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .navbar {
        background-color: #333;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
    }
    .nav-logo {
        color: white;
        font-weight: bold;
        font-size: 20px;
    }
    .nav-links {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center; 
    }
    .nav-links li {
        margin-left: 20px;
    }
    .nav-welcome {
        color: #ffa1f7; 
        font-size: 14px;
    }
    .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }
    .nav-links a:hover {
        color: #ffa1f7; 
    }
</style>

</body>
</html>