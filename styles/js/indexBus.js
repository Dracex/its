$ (document).ready (function () {
  $ ("#tableBuses").on ("click", ".despedido", function () {
    var bus = $ (this).attr ("id").substr (3);
    var r = confirm ("¿Seguro que desea despedir el bus " + bus + "?");
    if (r == true) {
      var idSalida = $ (this).parent ().parent ().attr ("id").substr (6);
      console.log (bus + " " + idSalida);
      var data = {};
      data ["idSalida"] = idSalida;
      $.ajax ({
        data: data,
        type: "POST",
        url: "sistema/informacionBuses.php?accion=despedir",
        success: function (response) {
          alert (response);
          cargarBus ();
        }
      })
    } else {
      alert ("No ha despedido el bus "+bus);
    }
  })
})

function cargarBus () {
  $.ajax ({
    url: "sistema/informacionBuses.php?accion=cargar",
    success: function (response) {
      $ ("#tableBuses").html ("");
      $ ("#tableBuses").append (response);
    }
  });
}