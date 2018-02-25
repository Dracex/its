<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }


  $stmtSalida = $conn->prepare ('SELECT * FROM salida');
  $stmtSalida->execute ();

  $datos = $stmtSalida->fetch ();

  $sitio = key ($_POST);

  $output = "";

  $cargar = "nuevo";

  $output .= "<div id='salida" . $_POST['id'] . "' class='divSalida'>";
  $output .= "<div class='campos'>";
  $output .= "<input type='number' id='busSalida" . $_POST['id'] . "' placeholder='Número Bus' class='izquierda'>";
  $output .= "<input type='text' id='posicionBusSalida" . $_POST['id'] . "' placeholder='Posición Bus' class='centro'>";
  $output .= "<select id='selectBusSalida" . $_POST['id'] . "' class='selectBusSalida derecha'>";
  include 'cargarDesplegableZona.php';
  $output .= "</select>";
  $output .= "</div>";
  $output .= "<div class='divHotelesSalida' id='divHotelesSalida" . $_POST['id'] . "'>";
  include 'cargarHoteles.php';
  $output .= "</div>";
  $output .= "</div>";
//    var_dump ($_POST);
//  }

  echo $output;
  