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
        <button onclick="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crear producto/servicio
        </button>

        <!-- CRUD PEDIDOS COMPRA -->
        <button onclick="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Pedidos de compra
        </button>

        <!-- MOVIMIENTOS -->
        <button onclick="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Movimientos
        </button>

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