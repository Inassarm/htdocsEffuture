<?php
session_start()
if(isset($_SESSION['clientes']))
    {
        $elnombre=base64_decode($_SESSION['clientes']);
        echo "<h1>privado2"</h1> $elnombre";

}
        else
            {
            header("location:login.html");
            }
?>