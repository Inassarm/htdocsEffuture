<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de la tabla todos</title>
</head>
<body>
    <h1>Consulta de la tabla todos</h1>
    <table border="1">
        <thead>
            
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>APELLIDOS</th>
        <th>EDAD</th> 
        <th colspan="2">ACCIONES</th>
    </tr>

        </thead>
        <tbody>
            <?php
            $con = new mysqli("10.10.10.160", "clase", "1234", "lunes15");
            
           
            if ($con->connect_error) {
                die("Error de conexión: " . $con->connect_error);
            }

            $sql = "SELECT * from todos ORDER BY nom_tod ASC";
            $resultado = $con->query($sql);

            foreach($resultado as $fila) {
                $id  = $fila["id_tod"];
                $nom = $fila["nom_tod"];
                $ape = $fila["ape_tod"];
                $age = $fila["edad_tod"];
                
                echo "
                <tr>
                    <td>$id</td>
                    <td>$nom</td>
                    <td>$ape</td>
                    <td>$age</td>
                    <td><a href= 'formulario.php?identificador=$id'> Editar </a></td>
                    <td><a href='eliminar.php?dato=$id'>Eliminar</a></td>
                </tr>";
            }

            $con->close();
            ?>
        </tbody>
    </table>
</body>
</html>