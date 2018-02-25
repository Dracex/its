<!DOCTYPE html>
<html>
  <?php
    $pagina = "index";
    include 'head.php';
  ?>
  <body>
    <?php
//      include 'header.php';
    ?>
    <section>
      <div id="tabs">
        <div class="tab activeTab" id="pasajeros">
          Buscar Pasajeros
        </div>
        <div class="tab" id="bus">
          Información Buses
        </div>
        <div class="tab" id="salidas">
          Salidas
        </div>
      </div>  
      <?php
        include 'pasajeros.php';
        include 'bus.php';
        include 'salidas.php';
      ?>
    </section>
    <?php
      include 'footer.php';
    ?>
  </body>
</html>
