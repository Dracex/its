<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "";

  $stmtSalida = $conn->prepare ('SELECT * FROM salida WHERE despedido != 1');
  $stmtSalida->execute ();

  $sitio = "cargarBus";
  $cargar = "cargar";
  
  while ($datos = $stmtSalida->fetch (PDO::FETCH_ASSOC)) {
    $output .= "<div id='salida" . $datos['idSalida'] . "' class='divSalida'>";
    $output .= "<div class='campos'>";
    $output .= "<input type='number' class='izquierda' id='busSalida" . $datos['idSalida'] . "' placeholder='Número Bus' value='" . $datos['bus'] . "'>";
    $output .= "<input type='text' class='centro' id='posicionBusSalida" . $datos['idSalida'] . "' placeholder='Posición Bus' value='" . $datos['posicion'] . "'>";
    $output .= "<select class='derecha selectBusSalida' id='selectBusSalida" . $datos['idSalida'] . "'>";
    include 'cargarDesplegableZona.php';
    $output .= "</select>";
    $output .= "<button class='botonMostrarHoteles independiente' id='mostrar" . $datos['idSalida'] . "'>+ Hoteles</button>";
    $output .= "</div>";
    $output .= "<div class='divHotelesSalida hidden' id='divHotelesSalida" . $datos['idSalida'] . "'>";
    include 'cargarHoteles.php';
    $output .= "</div>";
    $output .= "</div>";
  }
  echo $output;
  