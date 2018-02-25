<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $stmtConsultarSalidas = $conn->prepare ("SELECT count(idSalida) FROM salida");
  $stmtConsultarSalidas->execute ();

//  $output = "";

  while ($datosSalidas = $stmtConsultarSalidas->fetch ()) {
//    echo $output = $datosSalidas [0] . " >= " . $_POST['idSalida'];
    if ($datosSalidas[0] >= $_POST['idSalida']) {
      try {
        $stmtInsertarSalida = $conn->prepare ("UPDATE salida SET idZona = :idZona, idHotel = :idHotel, bus = :bus, posicion = :posicion WHERE idSalida = :idSalida");
        $stmtInsertarSalida->bindParam (":idSalida", $_POST['idSalida']);
        $stmtInsertarSalida->bindParam (":idZona", $_POST['zona']);
        $stmtInsertarSalida->bindParam (":idHotel", $_POST['hoteles']);
        $stmtInsertarSalida->bindParam (":bus", $_POST['bus']);
        $stmtInsertarSalida->bindParam (":posicion", $_POST['posicion']);
        $stmtInsertarSalida->execute ();
        $dentro = true;
      } catch (Exception $ex) {
        echo $ex;
      }
    } else {
      try {
        $stmtInsertarSalida = $conn->prepare ("INSERT INTO salida VALUES (:idSalida, :idZona, :idHotel, :bus, :posicion, 0, 0)");
        $stmtInsertarSalida->bindParam (":idSalida", $_POST['idSalida']);
        $stmtInsertarSalida->bindParam (":idZona", $_POST['zona']);
        $stmtInsertarSalida->bindParam (":idHotel", $_POST['hoteles']);
        $stmtInsertarSalida->bindParam (":bus", $_POST['bus']);
        $stmtInsertarSalida->bindParam (":posicion", $_POST['posicion']);
        $stmtInsertarSalida->execute ();
        $dentro = true;
      } catch (Exception $ex) {
        echo $ex;
      }
    }
  }
//  echo $output;
  echo $dentro;
  