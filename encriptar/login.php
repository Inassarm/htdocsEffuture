<?php
// Con esto verificamos si el formulario realmente fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ema = $_POST['correo'];
    $contra = $_POST['contra'];

    //El email lo tengo que cifrar tal cual esté grabado en la tabla, de lo contrario nunca lo encontraré.
    $emae = base64_encode($ema);

    //me conecto a la base64_decode
    $conexion = new mysqli("localhost", "root", "", "lunes_8");

    //sql para buscar el emae
    $sql = "SELECT * FROM clientes WHERE email_cli = '$emae'";
    //ejecuamos guardando el resultado
    $resultado = $conexion ->query($sql);

    //vamos a ver si hay más de una coincidencia
    if($resultado ->num_rows > 0){

        //sacamos los datos del resultado
        foreach($resultado as $fila)
        {
            $id = $fila["id_cli"];
            $nom = $fila["nom_cli"];
            $contraBD = $fila["password_cli"];

            //vamos a comprobar si el password está bien
            if(password_verify($contra, $contraBD))
            {
                //contraseña bien
                //crear una sesiòn
                session_start();

              
                $_SESSION["clientes"] = $nom; 
                
                //redireccionar a otro doc
                header("location:privado.php");
                exit(); 

            }
            else
            {
                echo "CONTRASEÑA INCORRECTA";
            }
        }
    }
    else{
        echo "EMAIL INCORRECTO";
    }

} else {
    // Si alguien entra directo a login.php sin pasar por el formulario
    echo "Por favor, inicia sesión desde el formulario. <a href='index.html'>Ir al Inicio</a>";
}

?>