$ (document).ready (function () {
  $ ("#add").click (function () {
    nuevaSalida ();
  })

  $ ("#save").click (function () {
    guardarSalida ();
  })

  $ ("#delete").click (function () {
    borrarSalida ();
  })

  $ ("#divSalidas").on ("click", ".botonMostrarHoteles", function () {
    var id = $ (this).attr ("id").substr (7);
    if ($ ("#divHotelesSalida" + id).hasClass("hidden")) {
      $(this).html("- Hoteles");
    } else {
      $(this).html("+ Hoteles");
    }
    $ ("#divHotelesSalida" + id).toggleClass ("hidden");
  })
})

function nuevaSalida () {
  var salidas = $ (".divSalida").length + 1;
  var data = {};
  console.log (salidas);
  data ["id"] = salidas;
  $.ajax ({
    data: data,
    type: "POST",
    url: 'sistema/nuevoBusIndex.php',
    success: function (response) {
      $ ("#divSalidas").append (response);
      $ (".divSalida").on ("change", ".selectBusSalida", function () {
        var id = $ (this).attr ("id");
        id = id.substr (15);
        var data = {};
        data["busNuevo"] = $ (this).val ();
        $.ajax ({
          data: data,
          type: 'post',
          url: 'sistema/cargarHoteles.php',
          success: function (response) {
//            console.log (response);
            $ ("#divHotelesSalida" + id).html (response);
          }
        })
      })
    }
  })
}

function cargarSalidas () {
  $.ajax ({
    url: 'sistema/cargarSalidasIndex.php',
    success: function (response) {
//      console.log (response);
      if (response == "") {
        nuevaSalida ();
      } else {
        $ ("#divSalidas").html (response);
        $ (".divSalida").on ("change", ".selectBusSalida", function () {
          cargarHoteles ($ (this).attr ("id"), $ (this).val (), "busNuevo");
        })

      }
    }
  });
}

function guardarSalida () {
  $ ("#save").html ("Enviando...");
  $ ("#save").attr ("disabled", true);

  var salidas = $ (".divSalida").length;


  for (var i = 0; i < salidas; i++) {
    var idSalida = $ (".divSalida:eq(" + i + ")").attr ("id").substr (6);
    var salida = {};
    salida['idSalida'] = idSalida;
    salida['bus'] = $ ("#busSalida" + idSalida).val ();
    if (salida['bus'] == "") {
      salida['bus'] = 0;
    }
    salida['posicion'] = $ ("#posicionBusSalida" + idSalida).val ();
    salida['zona'] = $ ("#selectBusSalida" + idSalida).val ();
    if (salida['zona'] == "") {
      salida['zona'] = 0;
    }
    var hoteles = "";
    for (var j = 0; j < $ ("#divHotelesSalida" + idSalida + " input[type='checkbox']:checked").length; j++) {
      hoteles += $ ("#divHotelesSalida" + idSalida + " input[type='checkbox']:checked:eq(" + j + ")").val () + ",";
    }
    salida['hoteles'] = hoteles;
    console.log (salida);
    $.ajax ({
      data: salida,
      type: "POST",
      url: 'sistema/guardarSalida.php',
      success: function (response) {
        console.log (response);
        if (response == 1) {
          $ ("#save").html ("Guardar");
          $ ("#save").attr ("disabled", false);
        } else {
          location.reload ();
        }
      }
    })
  }
}

function borrarSalida () {
  var r = confirm ("¿Seguro que desea borrar TODAS las salidas?");
  if (r == true) {
    $.ajax ({
      url: "sistema/vaciarSalidas.php",
      success: function (response) {
        location.reload ();
      }
    })
    alert ("Ha borrado todas las salidas");
  } else {
    alert ("Ha cancelado el borrado de las salidas");
  }
}

function cargarHoteles (idSalida, idZona, tipo) {
  idSalida = idSalida.substr (15);
  var data = {};
  data[tipo] = idZona;
  $.ajax ({
    data: data,
    type: 'post',
    url: 'sistema/cargarHoteles.php',
    success: function (response) {
//      console.log (response);
      $ ("#divHotelesSalida" + idSalida).html (response);
    }
  })
}