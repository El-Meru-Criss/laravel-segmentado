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