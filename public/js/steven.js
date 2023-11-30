function usuarios() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrar", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="tablita"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#tablita").html('<tr> <td> Nombre </td> <td> Estado </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#tablita").append('<tr>' + '<td>' + datos[i].usuario + '</td>' +  ' <td> ' + datos[i].estado + '</td>' + '</tr>');
            }
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}
/////////////////////////////////MODULO DE EMPLEADOS///////////////////////////////
function empleados() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarEmpleados", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="empleados"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#empleados").html('<tr> <td> Nombre empleado </td> <td> Apellido empleado </td> <td> Cargo </td> <td> Departamento </td> <td> Opciones </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#empleados").append('<tr>' + '<td>' + datos[i].nom_empleado + '</td>' + '<td>' + datos[i].ape_empleado + '</td>' + '<td>' + datos[i].cargo + '</td>' + '<td>' + datos[i].departamento + '</td>' + ' <td> <button onclick="Formulario_Editarempleado(' + datos[i].idEmpleado + ')"> editar </button> <button onclick="eliminarEmpleado(' + datos[i].idEmpleado + ')"> eliminar </button> </td>' + '</tr>');
            };
            $("#opciones").html('<button onclick="Formulario_Crearempleado()"> Crear Empleados </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function Formulario_Crearempleado() {
    $("#contenido").html('<label for="nom_empleado"> Nombre empleado: </label>    <input type="text" placeholder="Nombre empleado" id="nom_empleado">    <br>    <label for="ape_empleado"> Apellido empleado: </label>    <input type="text" placeholder="Apellido empleado" id="ape_empleado">    <br>    <label for="cargo"> Cargo: </label>    <input type="text" placeholder="Cargo" id="cargo">    <br>    <label for="departamento"> Departamento: </label>    <input type="text" placeholder="Departamento" id="departamento">');
    $("#opciones").html('<button onclick="crearEmpleado()"> Crear </button>');
}

var datosObtenidos;

function Formulario_Editarempleado(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnEmpleado",
        data:datos,
        success:function(d) {
            // Almacena los datos obtenidos
            datosObtenidos = d;

            // Llama a la función después de obtener los datos
            Formulario_Crearempleado();

            // Accede a las propiedades directamente
            
            $("#nom_empleado").val(datosObtenidos.nom_empleado);
            $("#ape_empleado").val(datosObtenidos.ape_empleado);
            $("#cargo").val(datosObtenidos.cargo);
            $("#departamento").val(datosObtenidos.departamento);

            $("#opciones").html('<button onclick="actualizarEmpleado('+ id + ')"> Actualizar </button>');
        }
      })
}

function crearEmpleado() {
    var datos = {
        "nom_empleado":$("#nom_empleado").val(),
        "ape_empleado":$("#ape_empleado").val(),
        "cargo":$("#cargo").val(),
        "departamento":$("#departamento").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearEmpleado",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            empleados();
        }
      })
}

function actualizarEmpleado(id) {
    var datos = {
        "id":id,
        "nom_empleado":$("#nom_empleado").val(),
        "ape_empleado":$("#ape_empleado").val(),
        "cargo":$("#cargo").val(),
        "departamento":$("#departamento").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarEmpleado",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            empleados();
        }
      })
}

function eliminarEmpleado(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "DELETE",
        url: "http://localhost:8000/api/eliminarEmpleado",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            empleados();
        }
      })
}

/////////////////////////////////MODULO DE LICENCIAS///////////////////////////////
function licencias() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarLicencias", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="licencias"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#licencias").html('<tr> <td> Descripcion </td> <td> Fecha de inicio </td> <td> Fecha final </td> <td> Tipo de licencia </td> <td> Empleado </td> <td> Opciones </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#licencias").append('<tr>' + '<td>' + datos[i].Descripcion + '</td>' + '<td>' + datos[i].fecha_ini + '</td>' + '<td>' + datos[i].fecha_fin + '</td>' + '<td>' + datos[i].nombre_tipo_licencia + '</td>' + '<td>' + datos[i].nom_empleado + '</td>' + ' <td> <button onclick="Formulario_Editarlicencia(' + datos[i].idLicencias + ')"> editar </button> <button onclick="eliminarLicencia(' + datos[i].idLicencias + ')"> eliminar </button> </td>' + '</tr>');
            };
            $("#opciones").html('<button onclick="Formulario_Crearlicencia()"> Crear Licencias </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function Formulario_Crearlicencia() {
    // Realiza una solicitud AJAX para obtener la lista de empleados y licencias
    $.ajax({
        url: "/api/mostrarEmpleados", // Asegúrate de que la URL sea correcta
        type: "GET",
        success: function(data) {
            // Construye las opciones del select con los datos obtenidos de la API
            var selectEmpleado = '<select id="selectempleado">';
            $.each(data, function(index, empleado) {
                selectEmpleado += '<option value="' + empleado.idEmpleado + '">' + empleado.nom_empleado + '</option>';
            });
            selectEmpleado += '</select>';

            // Realiza una segunda solicitud AJAX para obtener la lista de tipos de licencia
            $.ajax({
                url: "/api/mostrarTipoLicencia", // Asegúrate de que la URL sea correcta
                type: "GET",
                success: function(dataLicencias) {
                    var selectTipolicencia = '<select id="selectTipolicencia">';
                    $.each(dataLicencias, function(index, tipo_licencia) {
                        selectTipolicencia += '<option value="' + tipo_licencia.idtipo_licencia + '">' + tipo_licencia.nombre + '</option>';
                    });
                    selectTipolicencia += '</select>';

                    // Configura el contenido HTML con los selects
                    $("#contenido").html('<label for="Descripcion"> Descripcion: </label> <input type="text" placeholder="Descripcion" id="Descripcion"> <br> <label for="fecha_ini"> Fecha de inicio: </label> <input type="date" placeholder="Fecha de inicio" id="fecha_ini"> <br> <label for="fecha_fin"> Fecha final: </label> <input type="date" placeholder="Fecha final" id="fecha_fin"> <br> <label for="TipoLicencia"> Tipo de licencia: </label>' + selectTipolicencia + ' <br> <label for="empleado"> Empleado: </label>' + selectEmpleado);
                },
                error: function(errorLicencias) {
                    console.error("Error al obtener la lista de licencias desde la API", errorLicencias);
                }
            });
        },
        error: function(error) {
            console.error("Error al obtener la lista de empleados desde la API", error);
        }
    });
    
    $("#opciones").html('<button onclick="crearLicencia()"> Crear </button>');
}




var datosObtenidos;

function Formulario_Editarlicencia(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))
      Formulario_Crearlicencia();
      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnaLicencia",
        data:datos,
        success:function(d) {
            // Almacena los datos obtenidos
            datosObtenidos = d;
            //alert(JSON.stringify(datosObtenidos))
            // Llama a la función después de obtener los datos
            
            //alert(datosObtenidos.Descripcion)
            // Accede a las propiedades directamente
            
            $("#Descripcion").val(datosObtenidos.Descripcion);
            $("#fecha_ini").val(datosObtenidos.fecha_ini);
            $("#fecha_fin").val(datosObtenidos.fecha_fin);
            $("#tipo_licencia_idtipo_licencia").val(datosObtenidos.tipo_licencia_idtipo_licencia);
            $("#Empleado_idEmpleado").val(datosObtenidos.Empleado_idEmpleado);

            $("#opciones").html('<button onclick="actualizarLicencia('+ id + ')"> Actualizar </button>');
        }
      })
}

function crearLicencia() {
    var datos = {
        "Descripcion":$("#Descripcion").val(),
        "fecha_ini":$("#fecha_ini").val(),
        "fecha_fin":$("#fecha_fin").val(),
        "tipo_licencia_idtipo_licencia":$("#selectTipolicencia").val(),
        "Empleado_idEmpleado":$("#selectempleado").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearLicencia",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            licencias();
        }
      })
}

function actualizarLicencia(id) {
    var datos = {
        "id":id,
        "Descripcion":$("#Descripcion").val(),
        "fecha_ini":$("#fecha_ini").val(),
        "fecha_fin":$("#fecha_fin").val(),
        "tipo_licencia_idtipo_licencia":$("#selectTipolicencia").val(),
        "Empleado_idEmpleado":$("#selectempleado").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarLicencia",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            licencias();
        }
      })
}

function eliminarLicencia(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "DELETE",
        url: "http://localhost:8000/api/eliminarLicencia",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            licencias();
        }
      })
}

