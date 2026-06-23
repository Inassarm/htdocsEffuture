<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de 32 Inputs</title>
</head>
<body>

    <h2>Por favor, llena el formulario:</h2>
    
    <form action="recibir.php" method="POST">
        <?php
        for ($i = 1; $i <= 32; $i++) {
            echo "<label>Dato $i: </label>";
            echo "<input type='text' name='campo$i' placeholder='Ingresa el valor $i'><br><br>";
        }
        ?>
        <button type="submit">Enviar Datos</button>
    </form>

</body>
</html>