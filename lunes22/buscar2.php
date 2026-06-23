<?php
    $nom = $_POST['nombre'];
    $des = $_POST['descripcion'];
    $pre = $_POST['precio'];

    $con = new mysqli("10.10.10.160", "clase", "1234", "tienda");

    $sql = "INSERT INTO productos (titulo_pro, descripcion_pro, precio_pro) VALUES ('$nom','$des','$pre')";

    if($con->query($sql))
        {
            echo "<b> Grabado correctamente </b>";
        }
        else{
            echo "<font color='red'>Ocurrió un error</font>";
        }
?>