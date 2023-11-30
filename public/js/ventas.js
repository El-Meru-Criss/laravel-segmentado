function ventas() {
    $.ajax({
        type: "GET",
        url: "/api/mostrarventas",
        dataType: 'json',
        success:function(datos) {
            $("#contenido").html('<table id="ventas"> <table>');
            $("#ventas").html('<tr> <td> Precio Unidad </td> <td> Precio Servicio </td> <td> Fecha </td> <td> Cantidad Stock </td> <td> Precio Compra </td> <td> Cantidad </td> <td> Total Compra </td> <td> Total Venta </td> </tr>');

            for (var i = 0; i < datos.length; i++) {
                $("#ventas").append('<tr>' +
                    '<td>' + datos[i].precio_unidad + '</td>' +
                    '<td>' + datos[i].precio_servicio + '</td>' +
                    '<td>' + datos[i].fecha + '</td>' +
                    '<td>' + datos[i].cantidad_stock + '</td>' +
                    '<td>' + datos[i].precio_compra + '</td>' +
                    '<td>' + datos[i].cantidad + '</td>' +
                    '<td>' + datos[i].total_compra + '</td>' +
                    '<td>' + datos[i].total_venta + '</td>' +
                    ' <td> <button onclick="Formulario_EditarVenta(' + datos[i].venta_idventa + ')"> editar </button> <button onclick="eliminarVenta(' + datos[i].venta_idventa + ')"> eliminar </button> </td>' +
                    '</tr>');
            };

            $("#opciones").html('<button onclick="Formulario_CrearVenta()"> Crear Venta </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error);
        }
    });
}


function mostrarProductos() {
    $.ajax({
        type: "GET",
        url: "/api/mostrarproductos",
        dataType: 'json',
        success:function(datos) {
            $("#contenido").html('<table id="productosDetalles"> <table>');
            $("#productosDetalles").html('<tr> <td> Nombre Producto/Servicio </td> <td> Precio </td> <td> Cantidad Stock </td> <td> ID Proveedor </td> <td> Precio Compra </td> <td> Fecha Creación </td> <td> Total Compra </td> <td> Cantidad </td> <td> Venta </td> <td> Opciones </td> </tr>');

            for (var i = 0; i < datos.length; i++) {
                $("#productosDetalles").append('<tr>' +
                    '<td>' + datos[i].nom_producto_servicio + '</td>' +
                    '<td>' + datos[i].precio + '</td>' +
                    '<td>' + datos[i].cantidad_stock + '</td>' +
                    '<td>' + datos[i].proveedor_idproveedor + '</td>' +
                    '<td>' + datos[i].precio_compra + '</td>' +
                    '<td>' + datos[i].fecha_creacion + '</td>' +
                    '<td>' + datos[i].total_compra + '</td>' +
                    '<td>' + datos[i].cantidad + '</td>' +
                    '<td>' + datos[i].venta + '</td>' +
                    ' <td> <button onclick="Formulario_EditarProducto(' + datos[i].id_producto_servicio + ')"> editar </button> <button onclick="eliminarProducto(' + datos[i].id_producto_servicio + ')"> eliminar </button> </td>' +
                    '</tr>');
            };

            $("#opciones").html('<button onclick="Formulario_CrearProducto()"> Crear Producto </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error);
        }
    });
}

function mostrarfactura() {
    $.ajax({
        type: "GET",
        url: "/api/mostrarfactura",
        dataType: 'json',
        success:function(datos) {
            $("#contenido").html('<table id="factura"> <table>');
            $("#factura").html('<tr> <td> Nombre Empresa </td> <td> Fecha </td> <td> Total </td> <td> Producto/Servicio </td> <td> Opciones </td> </tr>');

            for (var i = 0; i < datos.length; i++) {
                $("#factura").append('<tr>' +
                    '<td>' + datos[i].nom_empresa + '</td>' +
                    '<td>' + datos[i].fecha + '</td>' +
                    '<td>' + datos[i].total + '</td>' +
                    '<td>' + datos[i].nom_producto_servicio + '</td>' +
                    ' <td> <button onclick="Formulario_EditarVenta(' + datos[i].venta_idventa + ')"> editar </button> <button onclick="eliminarVenta(' + datos[i].venta_idventa + ')"> eliminar </button> </td>' +
                    '</tr>');
            };

            $("#opciones").html('<button onclick="Formulario_CrearVenta()"> Crear Venta </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error);
        }
    });
}

