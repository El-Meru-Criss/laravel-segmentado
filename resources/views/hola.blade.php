<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Aqui convoca todos los CSS que usted use para sus estilos y tal -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <title>hola</title>
</head>
<body>

    <center>

        <br>
        <!-- Button trigger modal -->
        <button onclick="usuarios()" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
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
                    ...
                    <table >
                        <tr>
                            <td>nombre</td>
                            <td>estado</td>
                        </tr>
                        <tr>
                            <td>Criss</td>
                            <td>Z</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
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
    <script src="{{ asset('js/criss.js') }}"></script>
</html>