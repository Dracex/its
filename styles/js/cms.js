$ (document).ready (function () {

  $ (".selector").on ("click", function () {
    var accion = $ (this).attr ("id");
    switch (accion) {
      case "modificarHoteles":
        cargarBotonesHoteles ("modificar");
        break;
      case "crearHoteles":
        hotelesCrear ();
        break;
      case "borrarHoteles":
        cargarBotonesHoteles ("borrar");
        break;
      case "modificarZonas":
        zonasModificar ();
        break;
      case "crearZonas":
        zonasCrear ();
        break;
      case "borrarZonas":
        zonasBorrar ();
        break;
    }
  })
  $ ("#botones").on ("click", ".modificarBuses", function () {
    $ ("#buses div").empty ();
    var bus = $ (this).attr ("id").substr (3);
    var data = {};
    data ['bus'] = bus;
    $.ajax ({
      data: data,
      type: "POST",
      url: "../sistema/cms/cargarAdministrarBuses.php",
      success: function (response) {
        $ (".divCMS").addClass ("hidden");
        $ ("#buses").empty ();
        $ ("#buses").removeClass ("hidden");
        $ ("#buses").append (response);
      }
    })
  })

//  Trigger Evento Crear Hotel
  $ ("#hotelesCrear").on ("click", "#crearHotel", function () {
    $ ("#crearHotel").html ("Guardando...");
    $ ("#crearHotel").attr ("disabled", true);
    var data = {};
    data [$ ("#zonaHotelNuevo").val ()] = $ ("#hotelNuevo").val ();
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarHoteles.php?accion=crear",
      success: function (response) {
        $ ("#crearHotel").html ("Guardar");
        $ ("#crearHotel").attr ("disabled", false);
        $ ("#hotelNuevo").focus ();
        hotelesCrear ();
      }
    })
  })

//  Trigger Evento Modificar Hotel
  $ ("#hotelesModificarModificar").on ("keyup", "input", function () {
    var data = {};
    var id = "" + $ (this).attr ("id").substr (5);
    var val = $ (this).val ();
    data [id] = $.trim (val);
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarHoteles.php?accion=modificar&modificar=nombre",
    });
  });
//  Trigger Evento Modifcar Hotel 2
  $ ("#hotelesModificarModificar").on ("change", "select", function () {
    var id = "" + $ (this).attr ("id").substr (9);
    var val = $ (this).val ();
    var data = {};
    data [id] = val;
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarHoteles.php?accion=modificar&modificar=zona",
      success: function (response) {
//        cargarBotonesHoteles ();
      }
    });
  })

//  Trigger Evento Borrar Hotel
  $ ("#hotelesBorrarBorrar").on ("click", ".borrarHotel", function () {
    var data = {};
    data['id'] = $ (this).attr ("id").substr (5);
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarHoteles.php?accion=borrar",
      success: function (response) {
        if (response == 1) {
          $ ("#hoteles div").empty ();
          hotelesBorrar ();
        } else {
          alert ("Ha ocurrido un error y no se ha podido borrar el hotel");
        }
      }
    });
  })

//  Trigger Evento Modificar Zona
  $ ("#zonasModificar").on ("keyup", "input", function () {
    var data = {};
    var id = "" + $ (this).attr ("id").substr (4);
    var val = $ (this).val ();
    data [id] = $.trim (val);
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarZonas.php?accion=modificar",
    });
  });
//  Trigger Evento Crear Zona
  $ ("#zonasCrear").on ("click", "#crearZona", function () {
    $ ("#crearZona").html ("Guardando...");
    $ ("#crearZona").attr ("disabled", true);
    var data = {};
    data[0] = $ ("#zonaNueva").val ();
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarZonas.php?accion=crear",
      success: function (response) {
        $ ("#zonaNuevo").val ("");
        $ ("#crearZona").html ("Guardar");
        $ ("#crearZona").attr ("disabled", false);
      }
    })
  })
//  Trigger Evento Modificar Zona
  $ ("#hotelesModificar").on ("click", ".cargarZonaModificar", function () {
    var idZona = $ (this).attr ("id").substr (4);
    var data = {};
    data ['idZona'] = idZona;
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/cargarAdministrarHoteles.php?accion=modificar",
      success: function (response) {
        $ ("#hotelesModificarModificar").empty ();
        $ ("#hotelesModificarModificar").append (response);
      }
    })
  })
//  Trigger Evento Modificar Bus
  $ ("#buses").on ("keyup", ".pax", function () {
    var bus = $ (this).attr ("id").substr (3);
    var pax = $(this).val();
    console.log (bus + pax);
    console.log("hola");
    var data = {};
    data [bus] = pax;
    $.ajax ({
      method: "POST",
      data: data,
      url: "../sistema/cms/administrarBuses.php"
    })
  })


  $ ("#hotelesBorrar").on ("click", ".cargarZonaBorrar", function () {
    var idZona = $ (this).attr ("id").substr (4);
    var data = {};
    data ['idZona'] = idZona;
    $.ajax ({
      method: "POST",
      data: data,
      url: '../sistema/cms/cargarAdministrarHoteles.php?accion=borrar',
      success: function (response) {
//        $ (".divCMS").addClass ("hidden");
//        $ ("#hotelesBorrar").removeClass ("hidden");
//        $ ("#hotelesBorrar").append (response);
        $ ("#hotelesBorrarBorrar").empty ();
        $ ("#hotelesBorrarBorrar").append (response);
      }
    });
  })

});
function cargarBotonesHoteles (accion) {
  $.ajax ({
    url: '../sistema/cms/cargarAdministrarHoteles.php?elemento=botones&para=' + accion,
    success: function (response) {
      $ (".divCMS").addClass ("hidden");
      if (accion == "modificar") {
        $ ("#hotelesModificarModificar").removeClass ("hidden");
        $ ("#hotelesModificar").removeClass ("hidden");
        $ ("#hotelesModificar").empty ();
        $ ("#hotelesModificar").prepend (response);
      } else if (accion == "borrar") {
        $ ("#hotelesBorrarBorrar").removeClass ("hidden");
        $ ("#hotelesBorrar").removeClass ("hidden");
        $ ("#hotelesBorrar").empty ();
        $ ("#hotelesBorrar").prepend (response);
      }
    }
  });
}

function hotelesCrear () {
  $ ("#hotelesDiv div").empty ();
  $.ajax ({
    url: '../sistema/cms/cargarAdministrarHoteles.php?accion=crear',
    success: function (response) {
      $ (".divCMS").addClass ("hidden");
      $ ("#hotelesCrear").removeClass ("hidden");
      $ ("#hotelesCrear").append (response);
      $ ("#hotel").focus ();
    }
  });
}

function zonasModificar () {
  $ ("#zonasDiv div").empty ();
  $.ajax ({
    url: '../sistema/cms/cargarAdministrarZonas.php?accion=modificar',
    success: function (response) {
      $ (".divCMS").addClass ("hidden");
      $ ("#zonasModificar").removeClass ("hidden");
      $ ("#zonasModificar").append (response);
    }
  });
}

function zonasCrear () {
  $ ("#zonasDiv div").empty ();
  $.ajax ({
    url: '../sistema/cms/cargarAdministrarZonas.php?accion=crear',
    success: function (response) {
      $ (".divCMS").addClass ("hidden");
      $ ("#zonasCrear").removeClass ("hidden");
      $ ("#zonasCrear").append (response);
    }
  });
}