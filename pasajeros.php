<div id="pasajerosDiv" class="wrapper contentDiv">
  <div id="paxDivDiv">
    <input type="radio" class="searchMode" name="searchMode" id="searchModeNombre" value="Nombre" checked style="margin-left: 10px"><label for="searchModeNombre">Nombre</label>
    <input type="radio" class="searchMode" name="searchMode" id="searchModeHotel" value="Hotel"><label for="searchModeHotel">Hotel</label>    
  </div><br>
  <div class="campos">
    <input type="text" placeholder="Nombre" id="paxSearch" class="izquierda">
    <input type="number" placeholder="Cantidad" id="paxCant" class="centro">
    <button id="search" class="derecha">Buscar</button>
  </div>
  <div id="divPax">
    <div id="divPaxHoteles">
      <table id="tableHoteles" style="margin-top: 10px; width: 100%">
      </table>
    </div>
    <div id="divPaxPax"></div>
  </div>
</div>