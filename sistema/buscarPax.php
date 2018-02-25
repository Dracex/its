<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "<tr>";
  $output .= "<th>Num. Salida</th>";
  $output .= "<th>Nombre Reserva</th>";
  $output .= "<th>Cantidad</th>";
  $output .= "<th>Hotel</th>";
  $output .= "<th>Bus</th>";
  $output .= "<th>Posición</th>";
  $output .= "<th>Asientos libres</th>";
  $output .= "<th>Gestionar</th>";
  $output .= "</tr>";



  if ($_GET['data'] == "Hotel") {
    $stmtBusquedaNombre = $conn->prepare ('SELECT * FROM pasajeros WHERE hotel LIKE "%' . $_POST["nombre"] . '%" and cantidad like "%' . $_POST['cantidad'] . '%" and vistos != 1 ORDER BY hotel');
    $stmtBusquedaNombre->execute ();
    while ($datosBusquedaNombre = $stmtBusquedaNombre->fetch (PDO::FETCH_ASSOC)) {
      $stmtBusquedaHotel = $conn->prepare ('SELECT * FROM infoHoteles WHERE nombre LIKE "%' . $datosBusquedaNombre['hotel'] . '%" ORDER BY nombre');
      $stmtBusquedaHotel->execute ();
      while ($datosBusquedaHotel = $stmtBusquedaHotel->fetch (PDO::FETCH_ASSOC)) {
        $stmtBusquedaSalida = $conn->prepare ('SELECT * FROM salida WHERE idHotel LIKE "%' . $datosBusquedaHotel['idHotel'] . '%" AND idZona LIKE "%' . $datosBusquedaHotel['idZona'] . '%" AND despedido != 1');
        $stmtBusquedaSalida->execute ();
        while ($datosBusquedaSalida = $stmtBusquedaSalida->fetch (PDO::FETCH_ASSOC)) {
          $stmtBusquedaBus = $conn->prepare ('SELECT * FROM infoBus WHERE bus = ' . $datosBusquedaSalida['bus'] . '');
          $stmtBusquedaBus->execute ();
          $datosBusquedaBus = $stmtBusquedaBus->fetch (PDO::FETCH_ASSOC);
          $asientosLibres = $datosBusquedaBus['paxMax'] - $datosBusquedaSalida['pax'];
          $output .= "<tr id='pasajeros" . $datosBusquedaNombre['id'] . "'>";
          $output .= "<td>" . $datosBusquedaSalida['idSalida'] . "</td>";
          $output .= "<td>" . $datosBusquedaNombre['nombre'] . "</td>";
          $output .= "<td>" . $datosBusquedaNombre['cantidad'] . "</td>";
          $output .= "<td>" . $datosBusquedaHotel['nombre'] . "</td>";
          $output .= "<td>" . $datosBusquedaSalida['bus'] . "</td>";
          $output .= "<td>" . $datosBusquedaSalida['posicion'] . "</td>";
          $output .= "<td>" . $asientosLibres . "</td>";
          $output .= "<td><button class='visto independiente' id='salida" . $datosBusquedaSalida['idSalida'] . "'>Asignar</button></td>";
          $output .= "</tr>";
        }
      }
    }
  } else if ($_GET['data'] == "Nombre") {
    $stmtBusquedaNombre = $conn->prepare ('SELECT * FROM pasajeros WHERE nombre LIKE "%' . $_POST["nombre"] . '%" and cantidad like "%' . $_POST['cantidad'] . '%" and vistos != 1 ORDER BY nombre');
    $stmtBusquedaNombre->execute ();
    while ($datosBusquedaNombre = $stmtBusquedaNombre->fetch (PDO::FETCH_ASSOC)) {
      $stmtBusquedaHotel = $conn->prepare ('SELECT * FROM infoHoteles WHERE nombre LIKE "%' . $datosBusquedaNombre['hotel'] . '%" ORDER BY nombre');
      $stmtBusquedaHotel->execute ();
      while ($datosBusquedaHotel = $stmtBusquedaHotel->fetch (PDO::FETCH_ASSOC)) {
        $stmtBusquedaSalida = $conn->prepare ('SELECT * FROM salida WHERE idHotel LIKE "%' . $datosBusquedaHotel['idHotel'] . '%" AND idZona LIKE "%' . $datosBusquedaHotel['idZona'] . '%" AND despedido != 1');
        $stmtBusquedaSalida->execute ();
        while ($datosBusquedaSalida = $stmtBusquedaSalida->fetch (PDO::FETCH_ASSOC)) {
          $stmtBusquedaBus = $conn->prepare ('SELECT * FROM infoBus WHERE bus = ' . $datosBusquedaSalida['bus'] . '');
          $stmtBusquedaBus->execute ();
          $datosBusquedaBus = $stmtBusquedaBus->fetch (PDO::FETCH_ASSOC);
          $asientosLibres = $datosBusquedaBus['paxMax'] - $datosBusquedaSalida['pax'];
          $output .= "<tr id='pasajeros" . $datosBusquedaNombre['id'] . "'>";
          $output .= "<td>" . $datosBusquedaSalida['idSalida'] . "</td>";
          $output .= "<td>" . $datosBusquedaNombre['nombre'] . "</td>";
          $output .= "<td>" . $datosBusquedaNombre['cantidad'] . "</td>";
          $output .= "<td>" . $datosBusquedaHotel['nombre'] . "</td>";
          $output .= "<td>" . $datosBusquedaSalida['bus'] . "</td>";
          $output .= "<td>" . $datosBusquedaSalida['posicion'] . "</td>";
          $output .= "<td>" . $asientosLibres . "</td>";
          $output .= "<td><button class='visto independiente' id='salida" . $datosBusquedaSalida['idSalida'] . "'>Asignar</button></td>";
          $output .= "</tr>";
        }
      }
    }
  }

  echo $output;
  