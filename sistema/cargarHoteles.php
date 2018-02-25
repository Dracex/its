<?php

//  var_dump ($_POST);
  if ($sitio == "cargarBus") {
    $stmtHoteles = $conn->prepare ("SELECT * from infoHoteles where idZona =" . $datos['idZona']);
    $stmtHoteles->execute ();

    $idHoteles = explode (",", $datos['idHotel']);

    while ($datosHoteles = $stmtHoteles->fetch (PDO::FETCH_ASSOC)) {
      if (in_array ($datosHoteles['idHotel'], $idHoteles)) {
        $output .= "<input type='checkbox' name='hotel' id='hotel" . $datosHoteles['idHotel'] . "Salida" . $datos['idSalida'] . "' value='" . $datosHoteles['idHotel'] . "' checked><label for='hotel" . $datosHoteles['idHotel'] . "Salida" . $datos['idSalida'] . "'>" . $datosHoteles['nombre'] . "</label><br>";
      } else {
        $output .= "<input type='checkbox' name='hotel' id='hotel" . $datosHoteles['idHotel'] . "Salida" . $datos['idSalida'] . "' value='" . $datosHoteles['idHotel'] . "'><label for='hotel" . $datosHoteles['idHotel'] . "Salida" . $datos['idSalida'] . "'>" . $datosHoteles['nombre'] . "</label><br>";
      }
    }
  } else if (key ($_POST) == "busNuevo") {
    include 'db.php';

    try {
      $conn = conectar ();
    } catch (Exception $ex) {
      echo $ex;
    }

    $stmtHoteles = $conn->prepare ("SELECT * from infoHoteles where idZona = " . $_POST["busNuevo"]);

    $stmtHoteles->execute ();
    while ($datosHoteles = $stmtHoteles->fetch (PDO::FETCH_ASSOC)) {
      $output .= "<input type='checkbox' name='hotel' id='hotel" . $datosHoteles['idHotel'] . "' value='" . $datosHoteles['idHotel'] . "'><label for='hotel" . $datosHoteles['idHotel'] . "'>" . $datosHoteles['nombre'] . "</label><br>";
    }
    echo $output;
  }