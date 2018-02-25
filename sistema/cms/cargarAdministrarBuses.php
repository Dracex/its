<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }



  $stmtConsultarBus = $conn->prepare ("SELECT * FROM infoBus LIMIT 20 OFFSET " . ($_POST['bus'] - 99));
  $stmtConsultarBus->execute ();

  $output = "";
  while ($datos = $stmtConsultarBus->fetch (PDO::FETCH_ASSOC)) {
    $output .= '<input type="text" id="bus' . $datos['bus'] . '" placeholder="Bus" value="' . $datos ['bus'] . '">';
    $output .= '<input type="number" id="pax' . $datos['bus'] . '" class="pax" placeholder="Pasajeros" value="' . $datos ['paxMax'] . '"><br>';
  }
  echo $output;
  