<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

//obtenemos el archivo .csv
  $tipo = $_FILES['archivo']['type'];

  $tamanio = $_FILES['archivo']['size'];

  $archivotmp = $_FILES['archivo']['tmp_name'];

//cargamos el archivo
  $lineas = file ($archivotmp);

//inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
  $i = 0;

//Recorremos el bucle para leer línea por línea
  foreach ($lineas as $linea_num => $linea) {
//    var_dump($linea);
    //abrimos bucle
    /* si es diferente a 0 significa que no se encuentra en la primera línea 
      (con los títulos de las columnas) y por lo tanto puede leerla */
    if ($i != 0) {
      //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
      /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
        leyendo hasta que encuentre un ; */
      $datos = explode (",", $linea);
//      var_dump ($datos);
//      var_dump($datos);
      //Almacenamos los datos que vamos leyendo en una variable
      //usamos la función utf8_encode para leer correctamente los caracteres especiales
      echo "1";
      $nombre = trim ($datos[0]);
      if (strpos($nombre, "’")) {
        $nombre = str_replace("’", "'", $nombre);
      }
      echo "2";
      $cantidad = trim ($datos[1]);
      echo "3";
      $hotel = trim ($datos[2]);
      if (strpos($hotel, "’")) {
        $hotel = str_replace("’", "'", $hotel);
      }
      echo "4";

//      echo $nombre . $cantidad . $hotel;
      //guardamos en base de datos la línea leida
      try {
        $stmtImportarPasajeros = $conn->prepare ('INSERT INTO pasajeros(nombre,cantidad,hotel, vistos) VALUES("' . $nombre . '",' . $cantidad . ',"' . $hotel . '",0)');
        var_dump ($stmtImportarPasajeros);
        $stmtImportarPasajeros->execute ();
//       echo "Chuta";
      } catch (Exception $e) {
        echo $e;
      }
      //cerramos condición
    }
    $i++;

    /* Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
      entraremos en la condición, de esta manera conseguimos que no lea la primera línea. */
    //cerramos bucle
  }
//  header ('Location: /its/');
?>