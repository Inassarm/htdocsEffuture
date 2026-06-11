<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Imágenes</title>
</head>
<body>
    <a href="index.html">Inicio</a>
    <a href="subir.php">Grabar Imagen</a>
    <a href="ver.php">Ver imágenes</a>
    <hr>
    <h1>Imágenes por Cliente</h1>

    <?php
        include("conexion.php");
        
        $sql_clientes = "SELECT DISTINCT id_cli FROM imagenes WHERE id_cli <> '0'";
        $resultado_clientes = $con->query($sql_clientes);
    ?>

    <form action="ver.php" method="POST">
        <label>Selecciona el Cliente:</label>
        <select name="id_cliente" required>
            <option value="">-- Selecciona --</option>
            <?php
                // Recorrer los clientes 
                foreach($resultado_clientes as $cli) {
                    $id_opcion = $cli["id_cli"];
                    echo "<option value='$id_opcion'>Cliente $id_opcion</option>";
                }
            ?>
        </select>
        <button type="submit">Ver</button>
    </form>
    <hr>

    <?php
        // Si se seleccionó un cliente por el formulario, lo usamos. Si no, queda en '0'.
        $id_buscar = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '0';

        // Tu misma sintaxis de consulta filtrando por el ID elegido
        $sql = "SELECT id_cli, nom_ima FROM imagenes WHERE id_cli = '$id_buscar'";
        $resultado = $con->query($sql);
        
        foreach($resultado as $fila)
        {
            $id = $fila["id_cli"];
            $nombre = $fila["nom_ima"];
            
            // imagen con tu ruta (archivos2)
            echo "<p><img src='./archivos2/$id/$nombre' width='200'></p>";
        }
    ?>
    
</body>
</html>