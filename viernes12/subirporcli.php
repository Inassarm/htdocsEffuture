
!<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<a href="index.html">Inicio</a>
	<a href="subir.php">Grabar imagen</a>
    <a href="subirporcli.php">Grabar imagen para un cliente</a>
	<a href="verporcli.php">Ver imágenes</a>
    <a href="verporcli.php">Ver imágenes de clientes </a>
    <hr>
    <h1>Subir imágenes a un cliente</h1> 

	<hr>
	<form action="" method="POST" enctype="multipart/form-data">
        <select name="cliente">
    <?php
        include("conexion.php");
        $sql = "SELECT DISTINCT id_cli FROM imagenes";
        $resultado = $con->query($sql);

        foreach($resultado as $fila) {
            $idcli = $fila["id_cli"];
            echo "<option value='$idcli'>$idcli</option>";
        }
    ?>
</select>
        <br>
        <input type="file" name="lafoto">
        <br>
        <input type="submit" value="Subir">



    </form>

    <?php
    if($_POST)
        {
            $idclirecibido = $_POST["cliente"];
            $nombreimg = $_FILES["lafoto"]["name"];
            $tempimg = $_FILES["lafoto"]["tmp_name"];

            if($idclirecibido == 0){
                $ruta = "./archivos/$nombreimg";

            }
            else{
                $ruta = "./archivos/$idclirecibido/$nombreimg";

            }

            move_uploaded_file("tempimg", "./");

            //vamos a grabar
            $sql = "INSERT INTO imagenes (id_cli, nom_ima) VALUES ('$idclirecibido', '$nombreimg')";
            $con -> query($sql);
            echo "<p>imagen subida!!!!!</p>";

        }
    ?>
</body>
</html>