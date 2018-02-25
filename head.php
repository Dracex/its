<head>
  <meta charset="UTF-8">
  <title>ITS</title>

  <!-- Archivo básico -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--<script src="http://localhost/recordador/js/jQuery.js"></script>-->

  <?php
    if ($pagina == "index") {
      ?>
      <!-- CSS -->
      <link rel="stylesheet" href="styles/css/index.css"/>  
      <!--      <link rel="stylesheet" href="styles/css/bus.css"/>
            <link rel="stylesheet" href="styles/css/pax.css"/>-->

      <!-- JS -->
      <script src="styles/js/index.js"></script>
      <script src="styles/js/indexBus.js"></script>
      <script src="styles/js/indexSalidas.js"></script>
      <script src="styles/js/indexPax.js"></script>
      <?php
    } elseif ($pagina == "cms") {
      ?>
      <!-- CSS -->
      <link rel="stylesheet" href="../styles/css/cms.css"/>  

      <!-- JS -->
      <script src="../styles/js/cms.js"></script>
      <?php
    }
  ?>

</head>