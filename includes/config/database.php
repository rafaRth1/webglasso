<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'rafael', 'Miercoles19', 'webglasso');
 
    if(!$db){
        echo "Error no se pudo conectar";
    }
    return $db;
}

