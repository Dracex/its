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
      $stmtModificarZona = $conn->prepare ('UPDATE infoZona SET nombre = "' . $_POST[key ($_POST)] . '" WHERE idZona = ' . key ($_POST));
      $stmtModificarZona->execute ();
    } catch (Exception $ex) {
      $output .= $ex;
    }
  }

  if ($_GET['accion'] == "crear") {
    try {
      $stmtCrearZona = $conn->prepare ('INSERT INTO infoZona (nombre) VALUES ("' . $_POST[key ($_POST)] . '")');
      $stmtCrearZona->execute ();
      echo true;
    } catch (Exception $ex) {
      $output .= $ex;
    }
  }

  echo $output;
  