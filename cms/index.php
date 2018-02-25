<!DOCTYPE html>
<html>
  <?php
    $pagina = "cms";
    include '../head.php';
  ?>
  <body>
    <a href="../"><button id="volver" style="float:right">&lArr; Volver</button></a>
    <div id="pax" class="seccion">
      <b>Pasajeros</b><br>
      <form method="POST" enctype="multipart/form-data" action="../sistema/cms/importarPasajeros.php">
        <input type="file" name="archivo"><br>
        <input type="submit" value="Enviar">
      </form>
    </div>
    <div class="seccion">
      <div id="botonesHoteles" style="margin-top: 10px">
        <b>Hoteles</b><br>
        <button id="modificarHoteles" class="selector">Modificar</button>
        <button id="crearHoteles" class="selector">Crear</button>
        <button id="borrarHoteles" class="selector">Borrar</button>
      </div>
      <div id="hotelesDiv">
        <div id="hotelesModificar" class="divCMS hidden"></div>
        <div id="hotelesModificarModificar" class="divCMS"></div>
        <div id="hotelesCrear" class="divCMS hidden"></div>
        <div id="hotelesBorrar" class="divCMS hidden"></div>
        <div id="hotelesBorrarBorrar" class="divCMS"></div>
      </div>
    </div>
    <div class="seccion">
      <div id="botonesZonas" style="margin-top: 10px">
        <b>Zonas</b><br>
        <button id="modificarZonas" class="selector">Modificar</button>
        <button id="crearZonas" class="selector">Crear</button>
      </div>
      <div id="zonasDiv">
        <div id="zonasModificar" class="divCMS hidden"></div>
        <div id="zonasCrear" class="divCMS hidden"></div>
      </div>
    </div>
    <div class="seccion">
      <div id="botonesBuses" style="margin-top: 10px">
        <b>Buses</b><br>
        <div id="botones">
          <button id="bus099" class="modificarBuses">099 - 119</button>
          <button id="bus120" class="modificarBuses">120 - 139</button>
          <button id="bus140" class="modificarBuses">140 - 159</button>
          <button id="bus160" class="modificarBuses">160 - 179</button>
          <button id="bus180" class="modificarBuses">180 - 199</button>
          <button id="bus200" class="modificarBuses">200 - 219</button>
          <button id="bus220" class="modificarBuses">220 - 239</button>
          <button id="bus240" class="modificarBuses">240 - 259</button>
          <button id="bus260" class="modificarBuses">260 - 279</button>
          <button id="bus280" class="modificarBuses">280 - 299</button>
          <button id="bus300" class="modificarBuses">300 - 329</button>
          <button id="bus320" class="modificarBuses">320 - 339</button>
          <button id="bus340" class="modificarBuses">340 - 359</button>
          <button id="bus360" class="modificarBuses">360 - 379</button>
          <button id="bus380" class="modificarBuses">380 - 399</button>
          <button id="bus400" class="modificarBuses">400 - 429</button>
          <button id="bus420" class="modificarBuses">420 - 439</button>
          <button id="bus440" class="modificarBuses">440 - 459</button>
          <button id="bus460" class="modificarBuses">460 - 479</button>
          <button id="bus480" class="modificarBuses">480 - 499</button>
          <button id="bus500" class="modificarBuses">500 - 529</button>
          <button id="bus520" class="modificarBuses">520 - 539</button>
          <button id="bus540" class="modificarBuses">540 - 559</button>
          <button id="bus560" class="modificarBuses">560 - 579</button>
          <button id="bus580" class="modificarBuses">580 - 599</button>
        </div>
      </div>
      <div id="busesDiv">
        <div id="buses" class="divCMS hidden">
        </div>
      </div>
    </div>
  </body>
</html>