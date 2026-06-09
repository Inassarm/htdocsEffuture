<?php
//recoger datos del form
$pro = $_GET['provincia'];
//conectarme
$conexion = new mysqli("10.10.10.160","clase", "1234", "martes2");


$sql = "SELECT * FROM clientes where provincia = '$pro'" ;

//ejecutar guardando el resultado

$resultado = $conexion->query($sql);
//sacamos el número de filas del redsultado.

$filas_encontradas = $resultado -> num_rows;
//preguntamos si las filas encontradas son mayor que 0

if($filas_encontradas > 0)
{
    foreach($resultado as $fila)
    {
        //vamos a sacar los datos de los campos

        $id = $fila["id"];
        $nom = $fila["nombre"];
        $ape = $fila["apellidos"];
        $ema = $fila["email"];
        $pass = $fila["password"];
        $prov = $fila["provincia"];
        $nac = $fila["nacimiento"];
        $cp = $fila["cp"];

        echo "$id $nom $ape $ema $pass $prov $nac $cp <br>";
    }

//hay registros
//vamos a recorrer al resultado para sacar los datos

}else{

    echo "No hemos encontrado datos para la provincia $pro";

}

?>