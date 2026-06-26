<?php
$conexion = new mysqli("10.10.10.160", "clase", "1234", "tienda");
$resultado = $conexion->query("SELECT titulo_pro, precio_pro, descripcion_pro FROM productos");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<input type="text" id="Buscar" placeholder="Buscar...">
<br><br>

<table border="1" style="border-collapse: collapse;">
    <tbody>
    <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($fila["titulo_pro"]) ?></td>
            <td><?= htmlspecialchars($fila["precio_pro"]) ?></td>
            <td><?= htmlspecialchars($fila["descripcion_pro"]) ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<script>
$("#Buscar").on("keyup", function() {
    var buscar = $(this).val().toLowerCase();

    $("table tbody tr").css({"background": "", "font-weight": ""});

    if (buscar !== "") {
        $("table tbody tr").filter(function() {
            return $(this).text().toLowerCase().indexOf(buscar) > -1;
        }).css({"background": "pink", "font-weight": "bold"});
    }
});
</script>

</body>
</html>