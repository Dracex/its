<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "";

  if ($_GET['accion'] == "modificar") {
    try {
      if ($_GET['modificar'] == "nombre") {
        $stmtModificarHotel = $conn->prepare ('UPDATE infoHoteles SET nombre = "' . $_POST[key ($_POST)] . '" WHERE idHotel = ' . key ($_POST));
        $stmtModificarHotel->execute ();
        $output .= mb_detect_encoding(key($_POST));
      } else if ($_GET['modificar'] == "zona") {
        $stmtModificarHotel = $conn->prepare ('UPDATE infoHoteles SET idZona = "' . $_POST[key ($_POST)] . '" WHERE idHotel = ' . key ($_POST));
        $stmtModificarHotel->execute ();
      }
    } catch (Exception $ex) {
      $output .= $ex;
    }
  } else if ($_GET['accion'] == "borrar") {
    try {
      $stmtBorrarHotel = $conn->prepare ("DELETE FROM infoHoteles WHERE idHotel = " . $_POST['id']);
      $stmtBorrarHotel->execute ();
      echo true;
    } catch (Exception $ex) {
      $output .= $ex;
    }
  } else if ($_GET['accion'] == "crear") {
    try {
      $stmtCrearHotel = $conn->prepare ('INSERT INTO infoHoteles (nombre, idZona) VALUES ("' . $_POST[key ($_POST)] . '", ' . key ($_POST) . ')');
      $stmtCrearHotel->execute ();
      var_dump ($stmtCrearHotel);
      echo true;
    } catch (Exception $ex) {
      $output .= $ex;
    }
  }

  echo $output;
  