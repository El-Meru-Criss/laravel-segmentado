

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
            $("#inventario").html('<tr>                <td>PRODUCTO / SERVICIO</td>                <td>Descripcion</td>                <td>Precio</td>                <td>Stock</td>                <td>Opciones</td></tr>');
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#inventario").append('<tr>' + '<td>' + datos[i].nom_producto_servicio + '</td>' + '<td>' + datos[i].descripcion + '</td>' + '<td>' + datos[i].precio + '</td>' + '<td>' + datos[i].cantidad_stock + '</td>' +  ' <td> <button onclick="F_EProducto(' + datos[i].idProducto_servicio + ')" data-bs-toggle="modal" data-bs-target="#exampleModal"> editar </button> <button onclick="eliminarInventario(' + datos[i].idProducto_servicio + ')"> eliminar </button> </td>' + '</tr>');
            };
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function F_CProducto() {
    $("#contenido").html('<label for="nom_producto_servicio"> Producto/servicio: </label>    <input type="text" placeholder="producto/servicio" id="nom_producto_servicio">    <br>    <label for="descripcion"> descripcion: </label>    <input type="text" placeholder="descripcion" id="descripcion">    <br>    <label for="precio"> precio venta: </label>    <input type="number" placeholder="precio" id="precio">    <br>    <label for="cantidad_stock"> cantidad_stock: </label>    <input type="number" placeholder="cantidad_stock" id="cantidad_stock">  ');
    $("#opciones").html('<button onclick="crearProducto()"> Crear </button>');
    ProveedoresOption();
}

function ProveedoresOption() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarProveedor", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            
            $("#contenido").append('<br> <label for="proveedor_idproveedor">Proveedor</label> <select name="" id="proveedor_idproveedor"><option value="0">Nadie</option></select> <br> <label for="precio_compra"> Precio de Compra</label> <input id="precio_compra" type="number">');
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#proveedor_idproveedor").append('<option value="' + datos[i].idproveedor +'">' + datos[i].nom_empresa_pro +'</option>');
            };
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function F_EProducto(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnProducto",
        data:datos,
        success:function(d) {
            // Almacena los datos obtenidos
            datosObtenidos = d;

            // Llama a la función después de obtener los datos
            F_CProducto();

            // Accede a las propiedades directamente
            
            $("#nom_producto_servicio").val(datosObtenidos.nom_producto_servicio);
            $("#descripcion").val(datosObtenidos.descripcion);
            $("#precio").val(datosObtenidos.precio);
            $("#cantidad_stock").val(datosObtenidos.cantidad_stock);

            $("#opciones").html('<button onclick="actualizarProducto('+ id + ')"> Actualizar </button>');
        }
      })

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
            alert($("#proveedor_idproveedor").val())
            if ($("#proveedor_idproveedor").val() > 0) {
                crearProducto_Proveedor();
            }
        }
      })
}

function crearProducto_Proveedor() {
    var datos = {
        "proveedor_idproveedor":$("#proveedor_idproveedor").val(),
        "precio_compra":$("#precio_compra").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearProducto_Proveedor",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            mostrarInventario();
        }
      })
}

function actualizarProducto(id) {
    var datos = {
        "id":id,
        "nom_producto_servicio":$("#nom_producto_servicio").val(),
        "descripcion":$("#descripcion").val(),
        "precio":$("#precio").val(),
        "cantidad_stock":$("#cantidad_stock").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarProducto",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            mostrarInventario();
            añadir_producto_proveedor(id);
            F_EProducto(id);
        }
      })
}

function añadir_producto_proveedor(id) {
    var datos = {
        "producto":id,
        "proveedor_idproveedor":$("#proveedor_idproveedor").val(),
        "precio_compra":$("#precio_compra").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/añadirProducto_Proveedor",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
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

// ------- PEDIDOS DE COMPRA ---------------------------------------------------------

function F_CPedido_compra() {
    $("#contenido").html('<center> <input  type="number" hidden id="id_pedido">   <div id="enunciado">      <button onclick="Iniciar_Pedido()">Iniciar Pedido</button>    </div>  <br>  <div id="productos">    </div>  <br> <br>  <div id="productos_pedidos"></div>  </center>');
    $("#opciones").html('');
}

function Iniciar_Pedido() {
    $("#enunciado").html('  <h3 id="Nun_pedido">Pedido #</h3>    <label for="total_pedido">Costo Del Pedido</label>    <input disabled type="number" value="0" id="total_pedido">');
    $("#productos").html('  <label for="producto">producto</label>    <select name="" onchange="Proveedor_producto()" id="producto">      <option value="0">Nada</option>    </select>    <label for="Proveedor">Proveedor</label>    <select name="" onchange="Precio_compra()" id="Proveedor">      <option value="0">Nada</option>    </select>    <br>    <label for="cantidad">cantidad</label>    <input type="number" placeholder="cantidad" onchange="Costo_del_producto()" value="" id="cantidad">  <br>  <label for="precio_unitario">Precio Uniario</label>    <input type="number" disabled placeholder="precio unitario" id="precio_unitario">    <br><br>    <label for="costo">Costo del producto</label>    <input disabled id="costo" type="number" placeholder="costo">  <br> <br> <button onclick="Añadir_al_pedido()">Agregar a la Lista</button>');
    $("#productos_pedidos").html('  <h4>Productos pedidos:</h5>');

    $.ajax({
    type: "POST",
    url: "http://localhost:8000/api/crearOrden_Compra",
        success:function(d) {
            Numero_pedido();
            Productos_disponibles();
        }
    })
}

function Numero_pedido() {
    $.ajax({
    type: "GET",
    url: "http://localhost:8000/api/mostrarMasRecienteOrden_Compra",
        success:function(d) {
            $("#Nun_pedido").html('Pedido #' + d.idorden_compra);
            $("#id_pedido").val(d.idorden_compra);
        }
    })
}

function Productos_disponibles() {
    $.ajax({
    type: "GET",
    url: "http://localhost:8000/api/mostrarProducto_Proveedor",
        success:function(d) {
            for (var i = 0; i < d.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#producto").append('<option value="' + d[i].idProducto_servicio +'">' + d[i].nom_producto_servicio +'</option>');
            };
        }
    })
}

function Proveedor_producto() {
    var datos = {
        "id":$("#producto").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarProveedorProducto_Proveedor",
        data:datos,
        success:function(d) {
            var valor = 0;
            $("#precio_unitario").val(valor);
            Costo_del_producto();
            $("#Proveedor").html('<option value="0">Nada</option>');
            for (var i = 0; i < d.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#Proveedor").append('<option value="' + d[i].idproveedor +'">' + d[i].nom_empresa_pro +'</option>');
            };
        }
      })
}

function Precio_compra() {
    var datos = {
        "id":$("#producto").val(),
        "id2":$("#Proveedor").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarPrecioProducto_Proveedor",
        data:datos,
        success:function(d) {
            $("#precio_unitario").val(0);
            $("#precio_unitario").val(d.precio_compra);
            Costo_del_producto();
        }
      })
}

function Costo_del_producto() {
    var cantidad = $("#cantidad").val();
    var precio_uni = $("#precio_unitario").val();
    var total = cantidad * precio_uni;
    $("#costo").val(total);
}

function Añadir_al_pedido() {
    var idPedido = $("#id_pedido").val();
    var idProducto = $("#producto").val();
    var idProveedor = $("#Proveedor").val();
    var cantidad = $("#cantidad").val();
    var costo = $("#costo").val();
    
    var datos = {
        "idPedido":idPedido,
        "idProducto":idProducto,
        "idProveedor":idProveedor,
        "cantidad":cantidad,
        "costo":costo
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearProductos_Pedidos",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            MostrarProductosPedidos();
            ActualizarCostoOrden_Compra();
            mostrarInventario();
        }
      })
}

function MostrarProductosPedidos() {
    var datos = {
        "id":$("#id_pedido").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnosProducto",
        data:datos,
        success:function(d) {
            $("#productos_pedidos").html('<h4>Productos pedidos:</h5>Empresa - Producto - Cantidad <br>');
            
            for (var i = 0; i < d.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#productos_pedidos").append(d[i].nom_empresa_pro + ' - ' + d[i].nom_producto_servicio + ' - ' + d[i].cantidad + '<br>');
            };
        }
      })
}

function ActualizarCostoOrden_Compra() {

    var total_pedido = parseFloat($("#total_pedido").val());
    var costo = parseFloat($("#costo").val());
    var total_compra = costo + total_pedido;
    
    var datos = {
        "id":$("#id_pedido").val(),
        "total_compra":total_compra
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarOrden_Compra",
        data:datos,
        success:function(d) {
            $("#total_pedido").val(total_compra);
        }
      })
}

// ---------- Movimientos -------------------------------------------------------------------

function MostrarMovimientos() {
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarMovimientos",
        success:function(d) {
            $("#contenido").html('<h3>Movimientos</h3>  <table id="Movimientos" class="table">    <tr>      <td>Producto</td>      <td>Cantidad</td>      <td>Tipo</td>    </tr>  </table>');
            
            for (var i = 0; i < d.length; i++) {
                var tipoMovimiento = d[i].tipo == 0 ? 'Entrada' : 'Salida';
            
                // Agrega una fila con los datos consultados, incluyendo la columna de tipoMovimiento
                $("#Movimientos").append('<tr> <td>'+d[i].nom_producto_servicio+'</td> <td>'+d[i].cantidad+'</td> <td>'+tipoMovimiento+'</td> </tr>');
            };
            
        }
      })
}