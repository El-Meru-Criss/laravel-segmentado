<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Aqui convoca todos los CSS que usted use para sus estilos y tal -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <title>Empleados</title>
</head>
<body>
    
    <center>

        <br>
        <!-- Button trigger modal -->

        <!-- CRUD EMPLEADOS -->
        <button onclick="empleados()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        empleados
        </button>

        <!-- C PRODUCTO/SERVICIO -->
        <button onclick="licencias()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Permisos/Licencias/Vacaciones
        </button>
        <!-- Integracion API agregar evento google -->
        <button id="agregarEvento">Agregar a Google Calendar</button>
        <input type="text" id="Nombre_evento" placeholder='Nombre del evento'>
        <input type="text" id="Descripcion" placeholder='Descripcion del evento'>
        <input type="text" id="lugar" placeholder='Lugar del evento'>
        <input type="date" id="fecha" placeholder='Fecha del evento'>
        <script>
            document.getElementById('agregarEvento').addEventListener('click', function() {
                // Fecha del evento (debe estar en el formato YYYY-MM-DD)
                var fechaEvento = document.getElementById("fecha").value;
                
                // Detalles del evento
                var detallesEvento = {
                    'summary': document.getElementById("Nombre_evento").value,
                    'description': document.getElementById("Descripcion").value,
                    'location': document.getElementById("lugar").value,
                    'start': {
                    'dateTime': fechaEvento + 'T09:00:00',
                    'timeZone': 'America/Bogota', // Por ejemplo, 'America/Los_Angeles'
                    },
                    'end': {
                    'dateTime': fechaEvento + 'T17:00:00',
                    'timeZone': 'America/Bogota',
                    },
                    'reminders': {
                    'useDefault': false,
                    'overrides': [
                        {'method': 'popup', 'minutes': 30},
                        {'method': 'email', 'minutes': 24 * 60},
                    ],
                    },
                };
        
                // Crear el enlace del evento
                var enlaceEvento = 'https://www.google.com/calendar/render?action=TEMPLATE&dates=' +
                    detallesEvento.start.dateTime + '/' + detallesEvento.end.dateTime +
                    '&text=' + encodeURIComponent(detallesEvento.summary) +
                    '&details=' + encodeURIComponent(detallesEvento.description) +
                    '&location=' + encodeURIComponent(detallesEvento.location) +
                    '&sprop=&sprop=name:';
        
                // Abrir el enlace en una nueva pestaña
                window.open(enlaceEvento, '_blank');
            });
        </script>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenido">
                    
                </div>
                <div class="modal-footer" id="opciones">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>  

    </center>

</body>

    <!-- Aqui convoca todos los JS que usted use para sus funciones y eso -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/Steven.js') }}"></script>

</html>