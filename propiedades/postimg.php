<?php

require '../includes/config/database.php';
$db = conectarDB();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
   /*  echo "<pre>";
    var_dump($_POST);
    echo "</pre>"; */

    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";

    $nombre = $_POST['nombreproducto'];
    $precio = $_POST['precio'];

    // Asignar files hacia una variable

    $imagen = $_FILES['imagen'];

    // Validar por tamaño
    $medida = 1000 * 1000;    

    // SUBIDA DE ARCHIVOS

    // Crear carpeta
    $carpeta = '../src/img';

    if(!is_dir($carpeta)){ // is_dir = sirve para saber si la carpeta exite o no exite;
        mkdir($carpeta);
    }

    // Generar un nombre unico
    $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";


    // Subir la imagen
    move_uploaded_file($imagen['tmp_name'], $carpeta . "/" . $nombreImagen );

    // Insertar en la base de datos

    $query = "INSERT INTO productos (nombre, precio, imagen) VALUES ( '$nombre', '$precio', '$nombreImagen' )";

    /* echo $query; */

   $resultado = mysqli_query($db, $query);

   if($resultado){
       echo "Insertado correct";
   } else {
       echo "Mal";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <form action="/propiedades/postimg.php" class="formulario" method="POST" enctype="multipart/form-data">
      <fieldset>
        <label for="nombreproducto"></label>
        <input type="text" class="nombreproducto" name="nombreproducto" placeholder="nombre" />

        <label for="precio"></label>
        <input type="number" class="precio" placeholder="precio" name="precio"/>

        <label for="imagen"></label>
        <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen"/>
      </fieldset>

      <input type="submit" value="Mandar Imagen">

    </form>
  </body>
</html>
