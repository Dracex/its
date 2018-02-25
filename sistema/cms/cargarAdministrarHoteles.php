<?php

  include '../db.php';

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $output = "";
  $cargar = "cargar";
  if ($_GET['elemento'] == "botones") {
    if ($_GET['para'] == "modificar") {
      $stmtConsultarZonas = $conn->prepare ("SELECT * FROM infoZona");
      $stmtConsultarZonas->execute ();
      while ($datosConsultarZonas = $stmtConsultarZonas->fetch (PDO::FETCH_ASSOC)) {
        $output .= "<button class='cargarZonaModificar' id='zona" . $datosConsultarZonas['idZona'] . "'>" . $datosConsultarZonas['nombre'] . "</button>";
      }
    } elseif ($_GET['para'] == "borrar") {
      $stmtConsultarZonas = $conn->prepare ("SELECT * FROM infoZona");
      $stmtConsultarZonas->execute ();
      while ($datosConsultarZonas = $stmtConsultarZonas->fetch (PDO::FETCH_ASSOC)) {
        $output .= "<button class='cargarZonaBorrar' id='zona" . $datosConsultarZonas['idZona'] . "'>" . $datosConsultarZonas['nombre'] . "</button>";
      }
    }
  }
  if ($_GET['accion'] == "modificar") {
    $stmtConsultarHoteles = $conn->prepare ("SELECT * FROM infoHoteles WHERE idZona = " . $_POST['idZona'] . " order by idZona");
    $stmtConsultarHoteles->execute ();
    while ($datos = $stmtConsultarHoteles->fetch (PDO::FETCH_ASSOC)) {
      $output .= '<input type="text" id="hotel' . $datos['idHotel'] . '" placeholder="Hotel" value="' . $datos ['nombre'] . '">';
      $output .= "<select id='zonaHotel" . $datos['idHotel'] . "'>";
      include '../cargarDesplegableZona.php';
      $output .= "</select><br>";
    }
  }
  if ($_GET['accion'] == "borrar") {
    $stmtConsultarHoteles = $conn->prepare ("SELECT * FROM infoHoteles WHERE idZona = " . $_POST['idZona'] . " order by idZona");
    $stmtConsultarHoteles->execute ();
    while ($datos = $stmtConsultarHoteles->fetch (PDO::FETCH_ASSOC)) {
      $output .= '<input type="text" id="hotel' . $datos['idHotel'] . '" placeholder="Hotel" value="' . $datos ['nombre'] . '" disabled>';
      $output .= "<select id='zonaHotel" . $datos['idHotel'] . "' disabled>";
      include '../cargarDesplegableZona.php';
      $output .= "</select>";
      $output .= "<button id='hotel" . $datos['idHotel'] . "' class='borrarHotel'>X</button><br>";
    }
  }
  if ($_GET['accion'] == "crear") {
    $output .= "<input type='text' id='hotelNuevo' placeholder='Hotel' focus>";
    $output .= "<select id='zonaHotelNuevo'>";
    include '../cargarDesplegableZona.php';
    $output .= "</select>";
    $output .= "<button id='crearHotel'>Guardar</button>";
  }
  echo $output;
  