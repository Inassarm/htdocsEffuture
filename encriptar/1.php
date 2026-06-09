
<?php

// 1. Definimos la palabra original
$palabra = "hola";

// --- BLOQUE 1: HASHING DE UNA SOLA VÍA ---
// Nota: El hashing transforma el texto en un código único. No se puede "desencriptar".

// Genera un hash MD5 (32 caracteres hexadecimales).
// ¡Ojo! Hoy en día MD5 ya no es seguro para contraseñas porque se puede hackear fácilmente.
$palabramd5 = md5($palabra);
echo "MD5: $palabramd5<br>"; 

// Genera un hash seguro y moderno usando el algoritmo por defecto de PHP (actualmente bcrypt o Argon2).
// Este es el método correcto y seguro para guardar contraseñas en una base de datos.
$palabrahash = password_hash($palabra, PASSWORD_DEFAULT);
echo "Password Hash seguro: $palabrahash<br><br>";


// --- BLOQUE 2: CODIFICACIÓN EN DOS VÍAS (BASE64) ---
// Nota: Base64 NO es encriptación ni seguridad, es solo "codificación" para transportar datos.

// CORRECCIÓN: Para transformar texto limpio a Base64 se usa 'base64_encode' (tú tenías decode).
$palabrab64 = base64_encode($palabra); 
echo "Texto codificado en Base64: $palabrab64<br>";

// Para volver al texto original, ahora sí usamos 'base64_decode' sobre la variable codificada.
$palabrasinb64 = base64_decode($palabrab64);
echo "Texto decodificado (vuelve a la vida): $palabrasinb64";

// URL de tu servidor local donde estás probando este archivo:
// http://localhost/encriptar/1.php
?>