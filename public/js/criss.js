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