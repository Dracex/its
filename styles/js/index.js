$ (document).ready (function () {
  $ (".tab").click (function () {
    var id = $ (this).attr ("id");
    if (id == "salidas") {
      cargarSalidas ();
    } else if (id == "bus") {
      cargarBus ();
    }
    $ (".tab").removeClass ("activeTab");
    $ (this).addClass ("activeTab");
    $ (".contentDiv").addClass ("hidden");
    $ ("#" + id + "Div").removeClass ("hidden");
  })

  var heightFooter = $ ("#footerPagina").height ();
  $("body").css("padding-bottom", heightFooter);
})