$ (document).ready (function () {
  $ ("#pasajerosDiv").on ("click", "#search", function () {
    buscar ();
  })

  $ ("#divPaxHoteles").on ("click", "#agregar", function () {
    var idSalida = $ (this).parent ().parent ().attr ("id").substr (6);
    var paxNuevos = $ ("#paxNuevos" + idSalida).val ();
//    alert (paxNuevos);
    var data = {};
    $.ajax ({
      data: data,
      type: "POST",
      url: "sistema/administrarPax.php",
      success: function (response) {
        alert (response);
      }
    });
  })

  $ (document).on ("keyup", ".asientosNuevos", function () {
    if (parseInt ($ (this).val ()) > parseInt ($ (this).attr ("max"))) {
      $ (this).val ($ (this).attr ("max"));
    }
  })

  $ ("#paxSearch").keypress (function (e) {
    if (e.which == 13) {
      // Acciones a realizar, por ej: enviar formulario.
      buscar ();
    }
  });
  $ ("#paxCant").keypress (function (e) {
    if (e.which == 13) {
      // Acciones a realizar, por ej: enviar formulario.
      buscar ();
    }
  });

  $ ("#tableHoteles").on ("click", ".visto", function () {
    var idPasajeros = $ (this).parent ().parent ().attr ("id").substr (9);
    var idSalida = $ (this).attr ("id").substr (6);
    var data = {};
    data [idSalida] = idPasajeros;
    $.ajax ({
      data: data,
      type: "POST",
      url: "sistema/administrarPax.php",
      success: function (response) {
        alert (response);
        buscar ();
      }
    })
  })
})

function buscar () {
  var nombreBusqueda = $ ("#paxSearch").val ();
  var cantBusqueda = $ ("#paxCant").val ();
  var tipoBusqueda = $ ("input:radio[name=searchMode]:checked").val ();
  var data = {};
  data ["nombre"] = nombreBusqueda;
  data ['cantidad'] = cantBusqueda;
  $.ajax ({
    data: data,
    type: "POST",
    url: "sistema/buscarPax.php?data=" + tipoBusqueda,
    success: function (response) {
      $ ("#tableHoteles").html ("");
      $ ("#tableHoteles").append (response);
    }
  })
}