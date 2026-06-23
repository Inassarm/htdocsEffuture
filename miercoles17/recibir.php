<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
</head>
<body>

    <h2>Datos Recibidos:</h2>

    <?php
    for ($i = 1; $i <= 32; $i++) {

        $valor = $_POST["campo$i"] ?? 'Vacío';
        
       
        echo "<p><strong>Campo $i:</strong> $valor</p>";
    }
    ?>

    <p><a href="formulario.php">Volver al formulario</a></p>
    <form action=""></form>
    <i></i>

</body>
</html>