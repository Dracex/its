<?php


//Creamos la funcion  conectar que lo que hace es que cada vez que la llamamos nos conecta a la BD

  function conectar () {
    $username = "root";
    $password = "root";
    try {
      $conn = new PDO ('mysql:host=localhost;dbname=its', $username, $password);
    } catch (Exception $errorConexion) {
      echo "ERROR: $errorConexion";
    }
    return $conn;
  }

?>
