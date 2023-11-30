function usuarios() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarUsuarios", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="tablita"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#tablita").html('<tr> <td> Nombre </td> <td> correo </td> <td> rol </td> <td> empleado </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#tablita").append('<tr>' + '<td>' + datos[i].nom_usuario + '</td>' +  ' <td> ' + datos[i].correo + '</td>' +  ' <td> ' + datos[i].rol + '</td>' +  ' <td> ' + datos[i].nom_empleado + '</td>' + ' <td> <button onclick="Formulario_EditarUsuario(' + datos[i].idUsuario + ')"> editar </button> <button onclick="eliminarUsuario(' + datos[i].idUsuario + ')"> eliminar </button> </td>' + '</tr>');
            }
            $("#opciones").html('<button onclick="Formulario_Crearusuario()"> Crear Empleados </button>');
            
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

function Formulario_Crearusuario() {
    // Realiza una solicitud AJAX para obtener la lista de empleados
    $.ajax({
        url: "/api/mostrarEmpleados",
        type: "GET",
        success: function(data) {
            // Construye las opciones del select con los datos obtenidos de la API
            var selectEmpleado = '<select id="empleado">';
            $.each(data, function(index, empleado) {
                selectEmpleado += '<option value="' + empleado.idEmpleado + '">' + empleado.nom_empleado + '</option>';
            });
            selectEmpleado += '</select>';

            // Configura el contenido HTML con el select
            $("#contenido").html('<label for="nom_usuario"> Nombre de usuario: </label>    <input type="text" placeholder="Nombre de usuario" id="nom_usuario">    <br>    <label for="correo"> correo: </label>    <input type="email" placeholder="correo" id="correo">    <br>    <label for="constraseña"> constraseña: </label>    <input type="password" placeholder="constraseña" id="contrasena">    <br>    <label for="rol"> rol: </label>    <input type="text" placeholder="rol" id="rol" > <br>    <label for="empleado"> empleado: </label>' + selectEmpleado);
           
        },
        error: function(error) {
            console.error("Error al obtener la lista de empleados desde la API", error);
        }
    });
    $("#opciones").html('<button onclick="crearUsuario()"> Crear </button>');
}

var datosObtenidos;

function Formulario_EditarUsuario(id) {
    var datos = {
        "id": id
    };
    
    $.ajax({
        type: "GET",
        url: "http://localhost:8000/api/mostrarUnUsuario",
        data: datos,
        success: function (d) {
            // Almacena los datos obtenidos
            datosObtenidos = d;

            //llamamos el formulario
            Formulario_Crearusuario();

            // Itera sobre los datosObtenidos (suponiendo que es un array de objetos)
            $.each(datosObtenidos, function (index, datos) {
                // Accede a las propiedades del objeto y actualiza los valores en la interfaz de usuario
                $("#nom_usuario").val(datos.nom_usuario);
                $("#correo").val(datos.correo);
                $("#contrasena").val(datos.contrasena);
                $("#rol").val(datos.rol);
                $("#empleado").val(datos.idEmpleado);

                // Puedes hacer algo con cada conjunto de datos, por ejemplo, agregar a la interfaz de usuario
                $("#opciones").html('<button onclick="actualizarUsuario(' + id + ')"> Actualizar </button>');
            });
        }
    });

}

function crearUsuario() {
    var datos = {
        "nom_usuario":$("#nom_usuario").val(),
        "correo":$("#correo").val(),
        "contrasena":$("#contrasena").val(),
        "rol":$("#rol").val(),
        "Empleado_idEmpleado":$("#empleado").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearUsuario",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            usuarios();
        }
      })
}

function actualizarUsuario(id) {
    var datos = {
        "id":id,
        "nom_usuario":$("#nom_usuario").val(),
        "correo":$("#correo").val(),
        "contrasena":$("#contrasena").val(),
        "rol":$("#rol").val(),
        "Empleado_idEmpleado":$("#empleado").val()
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "PUT",
        url: "http://localhost:8000/api/actualizarUsuario",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            usuarios();
        }
      })
}

function eliminarUsuario(id) {
    var datos = {
        "id":id
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "DELETE",
        url: "http://localhost:8000/api/eliminarUsuario",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            usuarios();
        }
      })
}

function permisos() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarPermisos", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="tablita"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#tablita").html('<tr> <td> Nombre </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#tablita").append('<tr>' + '<td>' + datos[i].nom_permiso + '</td>' + '</tr>');
            }
            $("#opciones").html('<button onclick="permisosEmpleados()"> permisos de empleados </button>');
            
            $("#opciones").append('<button onclick="permisosUsuario()"> permisos de usuarios </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function permisosEmpleados() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarPermisosEmpleado_has_permisoController", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="tablita"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#tablita").html('<tr> <td> Nombre </td> <td> permisos </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#tablita").append('<tr>' + '<td>' + datos[i].nom_empleado + '</td>' + '<td>' + datos[i].nom_permiso + '</td>' + '</tr>');
            }
            $("#opciones").html('<button onclick="Formulario_AsignarPermisosEmpleado()"> asignar permisos </button>');
            $("#opciones").append('<button onclick="permisos()"> volver </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function permisosUsuario() {
    $.ajax({
        type: "GET", //selecciona el metodo pertinente
        url: "/api/mostrarUsuario_has_permisoController", //pone la url de su API
        dataType: 'json', //Define que los datos son de tipo Json
        success:function(datos) {
            $("#contenido").html('<table id="tablita"> <table>'); //con esto vacia el contenido del div y coloca una tabla
            $("#tablita").html('<tr> <td> Nombre </td> <td> permisos </td> </tr>'); //mete las primeras filas
            for (var i = 0; i < datos.length; i++) { //con este otro agrega una fila con los datos consultados
                $("#tablita").append('<tr>' + '<td>' + datos[i].nom_usuario + '</td>' + '<td>' + datos[i].nom_permiso + '</td>' + '</tr>');
            }
            $("#opciones").html('<button onclick="Formulario_AsignarPermisosUsuario()"> asignar permisos </button>');
            $("#opciones").append('<button onclick="permisos()"> volver </button>');
            
        }, error: function (error) {
            console.error('Error al obtener datos:', error); //por si no da la vaina
        }
      })
}

function Formulario_AsignarPermisosEmpleado() {
    // Realiza una solicitud AJAX para obtener la lista de empleados
    $.ajax({
        url: "/api/mostrarEmpleados",
        type: "GET",
        success: function(data) {
            // Construye las opciones del select con los datos obtenidos de la API
            var selectEmpleado = '<select id="empleado">';
            $.each(data, function(index, empleado) {
                selectEmpleado += '<option value="' + empleado.idEmpleado + '">' + empleado.nom_empleado + '</option>';
            });
            selectEmpleado += '</select>';

            // Realiza una solicitud AJAX para obtener la lista de permisos
            $.ajax({
                url: "/api/mostrarPermisos",
                type: "GET",
                success: function(datapermisos) {
                    // Construye las opciones del select con los datos obtenidos de la API
                    var selectPermisos = '<select id="Permisos">';
                    $.each(datapermisos, function(index, permiso) {
                        selectPermisos += '<option value="' + permiso.idpermiso + '">' + permiso.nom_permiso + '</option>';
                    });
                    selectPermisos += '</select>';

                    // Configura el contenido HTML con los select de empleados y permisos
                    $("#contenido").html('<label for="empleado">Empleado: </label>' + selectEmpleado + '<br><label for="permisos">Permiso: </label>' + selectPermisos);
                },
                error: function(errorPermisos) {
                    console.error("Error al obtener la lista de permisos desde la API", errorPermisos);
                }
            });
        },
        error: function(errorEmpleados) {
            console.error("Error al obtener la lista de empleados desde la API", errorEmpleados);
        }
    });

    $("#opciones").html('<button onclick="asignarPermisos()">asignar</button>');
}

function Formulario_AsignarPermisosUsuario() {
    // Realiza una solicitud AJAX para obtener la lista de usuarios
    $.ajax({
        url: "/api/mostrarUsuarios",
        type: "GET",
        success: function(data) {
            // Construye las opciones del select con los datos obtenidos de la API
            var selectUsuarios = '<select id="usuario">';
            $.each(data, function(index, usuario) {
                selectUsuarios += '<option value="' + usuario.idUsuario + '">' + usuario.nom_usuario + '</option>';
            });
            selectUsuarios += '</select>';

            // Realiza una solicitud AJAX para obtener la lista de permisos
            $.ajax({
                url: "/api/mostrarPermisos",
                type: "GET",
                success: function(datapermisos) {
                    // Construye las opciones del select con los datos obtenidos de la API
                    var selectPermisos = '<select id="Permisos">';
                    $.each(datapermisos, function(index, permiso) {
                        selectPermisos += '<option value="' + permiso.idpermiso + '">' + permiso.nom_permiso + '</option>';
                    });
                    selectPermisos += '</select>';

                    // Configura el contenido HTML con los select de usuarios y permisos
                    $("#contenido").html('<label for="usuario">Usuario: </label>' + selectUsuarios + '<br><label for="permisos">Permiso: </label>' + selectPermisos);
                },
                error: function(errorPermisos) {
                    console.error("Error al obtener la lista de permisos desde la API", errorPermisos);
                }
            });
        },
        error: function(errorUsuarios) {
            console.error("Error al obtener la lista de usuarios desde la API", errorUsuarios);
        }
    });

    $("#opciones").html('<button onclick="asignarUsuarios()">asignar</button>');
}


function asignarPermisos() {
    var datos = {
        "empleado":$("#empleado").val(),
        "Permisos":$("#Permisos").val(),
        "estado_empleado":1
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearEmpleado_has_permisoController",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            permisosEmpleados();
        }
      })
}

function asignarUsuarios() {
    var datos = {
        "usuario":$("#usuario").val(),
        "Permisos":$("#Permisos").val(),
        "estado_usuario":1
      };

      //alert(JSON.stringify(datos))

      $.ajax({
        type: "POST",
        url: "http://localhost:8000/api/crearUsuario_has_permisoController",
        data:datos,
        success:function(d) {
            alert(JSON.stringify(d));
            permisosUsuario();
        }
      })
}