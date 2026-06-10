<?php
// 1. Conexión rápida
$conexion = mysqli_connect("10.10.10.160", "clase", "1234", "martes9");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Recibir los datos
    $nombre   = $_POST['nom_per'];
    $correo   = $_POST['email_per'];
    $password = $_POST['pass_per']; 

    // 3. Insertar 
    $sql = "INSERT INTO personal (nom_per, email_per, pass_per) VALUES ('$nombre', '$correo', '$password')";

    if (mysqli_query($conexion, $sql)) {
        
        // 4. Obtener el ID que se acaba de crear
        $id_persona = mysqli_insert_id($conexion);
        $ruta_carpeta = "./fichero2/" . $id_persona;

        // 5. Crear la carpeta 
        mkdir($ruta_carpeta, 0777, true);

        // 6. Escribir algo simple dentro de la carpeta
        $ruta_archivo = $ruta_carpeta . "/datos.txt";
        $contenido = "ID: " . $id_persona . " - Nombre: " . $nombre;
        
        file_put_contents($ruta_archivo, $contenido);

        echo "Tudo bem";

    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>