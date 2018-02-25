<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $stmtConsultarZonas = $conn->prepare ("SELECT * FROM infoZona order by idZona");
  $stmtConsultarZonas->execute ();

  $output = "";
  $cargar = "cargar";
  if ($_GET['accion'] == "modificar") {
    while ($datos = $stmtConsultarZonas->fetch (PDO::FETCH_ASSOC)) {
      $output .= '<input type="text" id="zona' . $datos['idZona'] . '" placeholder="Zona" value="' . $datos ['nombre'] . '"><br>';
    }
  }
  if ($_GET['accion'] == "crear") {
    $output .= "<input type='text' id='zonaNueva' placeholder='Zona'>";
    $output .= "<button id='crearZona'>Guardar</button><br>";
  }
  echo $output;
  