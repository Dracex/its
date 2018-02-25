<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "";

  try {
    $stmtModificarZona = $conn->prepare ('UPDATE infoBus SET paxMax = "' . $_POST[key ($_POST)] . '" WHERE bus = ' . key ($_POST));
    $stmtModificarZona->execute ();
  } catch (Exception $ex) {
    $output .= $ex;
  }
  echo $output;
  