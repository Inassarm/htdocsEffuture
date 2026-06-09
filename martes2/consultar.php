<?php

// 🔹 ESTILOS
echo "
<style>
@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    body {
        font-family: 'Lato', sans-serif;
        background-color: #ffdada;
    }
    h1 {
    text-align: center;

 
    }

    nav {
        background-color: #ffdada;
        padding: 10px;
        margin-bottom: 30px;
    }

    nav a {
        color: black;
        margin-right: 10px;
        text-decoration: none;
        cursor: pointer;
    }

    a:hover {
        color: #ff8080;
    }

    h2 {
        text-align: center;
    }

    form {
        width: 300px;
        margin: auto;
        background-color: white;
        padding: 30px;
        
    }

    label {
        display: block;
        margin-top: 10px;
    }

    table {
    margin: auto; 
    border-collapse: collapse; 

    }


    input, select {
        width: 100%;
        padding: 5px;
        margin-top: 5px;
    }

    input[type=\"submit\"] {
        margin-top: 15px;
        background-color: #333;
        color: white;
        border: none;
        padding: 8px;
        cursor: pointer;
    }

    input[type=\"submit\"]:hover {
        background-color: rgb(214, 221, 219);
    }
</style>
";

// 🔹 NAV (también dentro de PHP correctamente)
echo "
<nav>
    <a href='index.html'>Home</a>
    <a href='altas.html'>Altas</a>
    <a href='consultar.php'>Consultas</a>
</nav>
";

// 🔹 CONEXIÓN
$conexion = new mysqli("10.10.10.160", "clase", "1234", "martes2");

// 🔹 CONSULTA
$sql = "SELECT * FROM clientes";
$resultado = $conexion->query($sql);

// 🔹 MOSTRAR RESULTADOS


echo "

<h1> Mis estudiantes </h1>
<table border='1' cellpadding='8' cellspacing='0'>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Provincia</th>
            <th>Nacimiento</th>
            <th>Código Postal</th>
        </tr>
    </thead>
    <tbody>
";
foreach ($resultado as $fila)
{
    echo "<tr>";
    echo "<td>" . $nom = $fila["nombre"] . "</td>";
    echo "<td>" . $ape = $fila["apellidos"] . "</td>";
    echo "<td>" . $ema = $fila["email"] . "</td>";
    echo "<td>" . $prov = $fila["provincia"] . "</td>";
    echo "<td>" . $nac = $fila["nacimiento"] . "</td>";
    echo "<td>" . $cp = $fila["cp"] . "</td>";

    echo "</tr>";
}

?>


