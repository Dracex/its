<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }



  if ($_GET['accion'] == "despedir") {
    $output = $_POST['idSalida'];
    try {
      $stmtDespedirBus = $conn->prepare ('UPDATE salida SET despedido = ' . true . ' WHERE idSalida = ' . $_POST['idSalida']);
      $stmtDespedirBus->execute ();
      $stmtBuscarSalida = $conn->prepare ("SELECT * FROM salida WHERE idSalida = " . $_POST['idSalida']);
      $stmtBuscarSalida->execute ();
      $datosBuscarSalida = $stmtBuscarSalida->fetch (PDO::FETCH_ASSOC);
      $output = "El bus: " . $datosBuscarSalida['bus'] . " ha sido despedido.";
    } catch (Exception $ex) {
      echo $ex;
    }
  } elseif ($_GET['accion'] == "cargar") {
    $output = "<tr>";
    $output .= "<th>Num. Salida</th>";
    $output .= "<th>Bus</th>";
    $output .= "<th>Zona</th>";
    $output .= "<th>Asientos Ocupados</th>";
    $output .= "<th>Asientos Totales</th>";
    $output .= "<th>% Asientos Ocupados</th>";
    $output .= "<th>Gestionar</th>";
    $output .= "</tr>";

    $stmtBusquedaSalida = $conn->prepare ('SELECT * FROM salida WHERE despedido != 1');
    $stmtBusquedaSalida->execute ();
    while ($datosBusquedaSalida = $stmtBusquedaSalida->fetch (PDO::FETCH_ASSOC)) {
      $stmtBusquedaZona = $conn->prepare ('SELECT nombre FROM infoZona WHERE idZona = ' . $datosBusquedaSalida['idZona']);
      $stmtBusquedaZona->execute ();
      $datosBusquedaZona = $stmtBusquedaZona->fetch (PDO::FETCH_ASSOC);

      $stmtBusquedaBus = $conn->prepare ('SELECT paxMax FROM infoBus WHERE bus = ' . $datosBusquedaSalida['bus']);
      $stmtBusquedaBus->execute ();
      $datosBusquedaBus = $stmtBusquedaBus->fetch (PDO::FETCH_ASSOC);

      $porcentajeAsientos = round ($datosBusquedaSalida['pax'] / $datosBusquedaBus['paxMax'] * 100, 0);
      if ($porcentajeAsientos == NaN) {
        $porcentajeAsientos = "0";
      }
      if ($porcentajeAsientos >= 0 && $porcentajeAsientos <= 49) {
        $color = "#0F0";
      } elseif ($porcentajeAsientos >= 50 && $porcentajeAsientos <= 74) {
        $color = "#F80";
      } elseif ($porcentajeAsientos >= 75 && $porcentajeAsientos <= 100) {
        $color = "#F00";
      }

      $output .= "<tr id='salida" . $datosBusquedaSalida['idSalida'] . "'>";
      $output .= "<td>" . $datosBusquedaSalida['idSalida'] . "</td>";
      $output .= "<td>" . $datosBusquedaSalida['bus'] . "</td>";
      $output .= "<td>" . $datosBusquedaZona['nombre'] . "</td>";
      $output .= "<td>" . $datosBusquedaSalida['pax'] . "</td>";
      $output .= "<td>" . $datosBusquedaBus['paxMax'] . "</td>";
      $output .= "<td><div class='barraExterior' style='border: 1px solid $color; '><div class='barraInterior' style='border: 1px solid $color; background-color: $color; width: " . $porcentajeAsientos . "%; height: 100%'>" . $porcentajeAsientos . "%</div></div></td>";
      $output .= "<td><button class='despedido independiente' id='bus" . $datosBusquedaSalida['bus'] . "'>Despedir</button></td>";
      $output .= "</tr>";
    }
  }

  echo $output;
  