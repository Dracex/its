<?php

  $stmtZona = $conn->prepare ('SELECT * FROM infoZona order by nombre');
  $stmtZona->execute ();

  $output .= "<option value=''>Selecciona una Zona</option>";

  if ($cargar == "cargar") {
    while ($datosZona = $stmtZona->fetch (PDO::FETCH_ASSOC)) {
      if ($datos['idZona'] == $datosZona['idZona']) {
        $output .= "<option value='" . $datosZona['idZona'] . "' selected>" . $datosZona['nombre'] . "</option>";
      } else {
        $output .= "<option value='" . $datosZona['idZona'] . "'>" . $datosZona['nombre'] . "</option>";
      }
    }
  } else if ($cargar == "nuevo") {
    while ($datosZona = $stmtZona->fetch (PDO::FETCH_ASSOC)) {
      $output .= "<option value='" . $datosZona['idZona'] . "'>" . $datosZona['nombre'] . "</option>";
    }
  }