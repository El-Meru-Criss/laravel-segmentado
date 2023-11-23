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

function proveedores() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarProveedor", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="proveedores"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#proveedores").html('<tr> <td> Empresa </td> <td> Opciones </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#proveedores").append('<tr>' + '<td>' + datos[i].nom_empresa_pro + '</td>' +  ' <td> <button onclick="F_EProveedor(' + datos[i].idproveedor + ')"> editar </button> <button onclick="eliminarProveedor(' + datos[i].idproveedor + ')"> eliminar </button> </td>' + '</tr>');
            };
            $("#opciones").html('<button onclick="F_CProveedor()"> Crear Proveedores </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function F_CProveedor() {
    $("#contenido").html('<label for="empresa"> Empresa: </label>    <input type="text" placeholder="Empresa" id="Empresa">    <br>    <label for="Representante"> Representante: </label>    <input type="text" placeholder="persona de contacto" id="Representante">    <br>    <label for="direccion"> direccion: </label>    <input type="text" placeholder="direccion" id="direccion">    <br>    <label for="telefono"> telefono: </label>    <input type="text" placeholder="telefono" id="telefono">    <br><label for="correo"> correo: </label><input type="email" placeholder="correo" id="correo">');
    $("#opciones").html('<button onclick="crearProveedor()"> Crear </button>');
}

var datosObtenidos;

function F_EProveedor(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnProveedor",
        data:datos,
        success:function(d) {
            // Almacena los datos obtenidos
            datosObtenidos = d;

            // Llama a la función después de obtener los datos
            F_CProveedor();

            // Accede a las propiedades directamente
            
            $("#Empresa").val(datosObtenidos.nom_empresa_pro);
            $("#Representante").val(datosObtenidos.per_conctacto_pro);
            $("#direccion").val(datosObtenidos.direccion_pro);
            $("#telefono").val(datosObtenidos.telefono_pro);
            $("#correo").val(datosObtenidos.correo_pro);

            $("#opciones").html('<button onclick="actualizarProveedor('+ id + ')"> Actualizar </button>');
        }
      })
}

function crearProveedor() {
    var datos = {
        "Empresa":$("#Empresa").val(),
        "Representante":$("#Representante").val(),
        "direccion":$("#direccion").val(),
        "telefono":$("#telefono").val(),
        "correo":$("#correo").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearProveedor",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            proveedores();
        }
      })
}

function actualizarProveedor(id) {
    var datos = {
        "id":id,
        "Empresa":$("#Empresa").val(),
        "Representante":$("#Representante").val(),
        "direccion":$("#direccion").val(),
        "telefono":$("#telefono").val(),
        "correo":$("#correo").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarProveedor",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            proveedores();
        }
      })
}

function eliminarProveedor(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "DELETE",
        url: "http://localhost:8000/api/eliminarProveedor",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            proveedores();
        }
      })
}

// ------- INVENTARIOS ---------------------------------------------------------

function mostrarInventario() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarInventario", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#inventario").html('');
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#inventario").append('<tr>' + '<td>' + datos[i].nom_producto_servicio + '</td>' + '<td>' + datos[i].descripcion + '</td>' + '<td>' + datos[i].precio + '</td>' + '<td>' + datos[i].cantidad_stock + '</td>' +  ' <td> <button onclick="editarProducto(' + datos[i].idProducto_servicio + ')"> editar </button> <button onclick="eliminarInventario(' + datos[i].idProducto_servicio + ')"> eliminar </button> </td>' + '</tr>');
            };
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function F_CProducto() {
    $("#contenido").html('<label for="nom_producto_servicio"> Producto/servicio: </label>    <input type="text" placeholder="producto/servicio" id="nom_producto_servicio">    <br>    <label for="descripcion"> descripcion: </label>    <input type="text" placeholder="descripcion" id="descripcion">    <br>    <label for="precio"> precio venta: </label>    <input type="number" placeholder="precio" id="precio">    <br>    <label for="cantidad_stock"> cantidad_stock: </label>    <input type="number" placeholder="cantidad_stock" id="cantidad_stock">    ');
    $("#opciones").html('<button onclick="crearProducto()"> Crear </button>');
}

function crearProducto() {
    var datos = {
        "nom_producto_servicio":$("#nom_producto_servicio").val(),
        "descripcion":$("#descripcion").val(),
        "precio":$("#precio").val(),
        "cantidad_stock":$("#cantidad_stock").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearInventario",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            mostrarInventario();
        }
      })
}

function eliminarInventario(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "DELETE",
        url: "http://localhost:8000/api/eliminarInventario",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            mostrarInventario();
        }
      })
}