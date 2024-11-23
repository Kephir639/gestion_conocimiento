$(document).ready(function () {
  let button = "";
  //Metodo para abrir la modal de modificar
  $(document).on("click", ".iconoModificar", function () {
    button = $(this);

    let nombreRol = $(button).parents("tr").find("td:eq(0)").text().trim();
    let estadoRol = $(button).parents("tr").find("td:eq(1)").text().trim();

    let estado = estadoRol == "Activo" ? 1 : estadoRol == "Inactivo" ? 0 : -1;

    $.ajax({
      type: "GET",
      url: "permisoRol",
      data: {
        nombre_rol: nombreRol,
      },
      success: function (data) {
        let permisos = data.permisos;

        $.ajax({
          type: "GET",
          url: "showModalActualizar",
          data: {
            permisos: permisos,
          },
          success: function (data) {
            $("#ModalSection").html(data.modal);

            $("#modalModificarRol").find("#inputNombreRol").val(nombreRol);
            $("#modalModificarRol").find("#inputEstadoRol").val(estado);

            $("#modalModificarRol").modal("show");
          },
        });
      },
    });
  });

  $(document).on("click", "#btnActualizar", function (e) {
    e.preventDefault();
    
    $.ajax({
      type: "GET",
      url: "funciones",
      success: function (dataGET) {
        let nombre = $("#inputNombreRol").val();
        let nombre_old = button.parents('tr').find('td:eq(0)').text().trim();
        let estado = $("#inputEstadoRol").val();
        let token = $("#_token").val();
        let funciones = dataGET; //Antes de actualizar
        let funciones_actualizadas = [];
        $('input[type="checkbox"][name="checkFunciones[]"]:checked').each(
          function () {
            funciones_actualizadas.push(this.value);
          }
        );
        let funcionesAgregadas = null;
        let funcionesEliminadas = null;
        funcionesAgregadas = funciones_actualizadas.filter(
          (funcion) => !funciones.includes(funcion)
        );
        funcionesEliminadas = funciones.filter(
          (funcion) => !funciones_actualizadas.includes(funcion)
        );

        $.ajax({
          type: "POST",
          url: "actualizar_roles",
          data: {
            'nombre_rol': nombre,
            'estado_rol': estado,
            'nombre_rol_old': nombre_old,
            'funciones_agregadas': funcionesAgregadas,
            'funciones_eliminadas': funcionesEliminadas,
            '_token': token,
          },
          success: function (data) {
            $("#alertasModificar").html(data.alerta);
            $(button).parents("tr").find("td:eq(0)").text(nombre);
            $(button).parents("tr").find("td:eq(1)").val(estado);
          },
          error: function (xhr, status, error) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;

              $.each(errors, function (clave, valor) {
                $("#div_" + clave)
                  .find(".errorValidacion")
                  .html(valor);
              });
            }
          },
        });
      },
    });
  });


  $(document).on("click", "#BtnRegistrarRol", function () {
    button = $(this);
    $.ajax({
      type: "GET",
      url: "showModalRegistrar",
      success: function (data) {
        $("#ModalSection").html(data.modal);
        $("#modalRegistrarRol").modal("show");
      },
    });
  });


  $(document).on("click", "#btnRegistrar", function (e) {
    e.preventDefault();
    let nombre_rol = $("#inputNombreRol").val();
    let token = $("#_token").val();
    let funciones = [];

    $('input[name="checkFunciones[]"]:checked').each(function () {
      funciones.push($(this).val());
    });

    $.ajax({
      type: "POST",
      url: "crear_roles",
      data: {
        _token: token,
        nombre_rol: nombre_rol,
        funciones: funciones,
      },

      success: function (data) {
        //Mostrar los registros actualizados
        $("#tablebody_roles").html(data.tabla);
        //Mostrar Alerta
        $("#alertasRegistrar").html(data.alerta);
      },
      error: function (xhr, status, error) {
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;

          $.each(errors, function (clave, valor) {
            $("#div_" + clave)
              .find(".errorValidacion")
              .html(valor);
          });
        }
      },
    });
  });
});
