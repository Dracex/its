<?php

  include "db.php";

  try {
    $conn = conectar ();
  } catch (Exception $ex) {
    echo $ex;
  }

  $stmt = $conn->prepare ("truncate table salida");

  $stmt->execute ();
  