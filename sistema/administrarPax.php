<?php

  include 'db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "";

  $stmtVerPasajeros = $conn->prepare ("UPDATE pasajeros SET vistos = " . true . " where id = " . $_POST[key ($_POST)]);
  $stmtVerPasajeros->execute ();

  $stmtBusquedaPasajeros = $conn->prepare ("SELECT * FROM pasajeros where id = " . $_POST[key ($_POST)]);
  $stmtBusquedaPasajeros->execute ();
  $datosBusquedaPasajeros = $stmtBusquedaPasajeros->fetch (PDO::FETCH_ASSOC);
  $cantidad = $datosBusquedaPasajeros['cantidad'];
  $stmtBusquedaSalida = $conn->prepare ("SELECT * FROM salida where idSalida = " . key ($_POST));
  $stmtBusquedaSalida->execute ();
  $datosBusquedaSalida = $stmtBusquedaSalida->fetch (PDO::FETCH_ASSOC);
  $cantidadSalida = $datosBusquedaSalida['pax'];
  $nuevoPax = $cantidadSalida + $cantidad;
  $stmtVerPasajeros = $conn->prepare ("UPDATE salida SET pax = " . $nuevoPax . " where idSalida = " . key ($_POST));
  $stmtVerPasajeros->execute ();

  $output .= "El pasajero con nombre: " . $datosBusquedaPasajeros['nombre'] . "(" . $datosBusquedaPasajeros['cantidad'] . " personas).\nTiene el bus " . $datosBusquedaSalida['bus'] . " asignado y está en: " . $datosBusquedaSalida['posicion'] . ".";

  echo $output;
  