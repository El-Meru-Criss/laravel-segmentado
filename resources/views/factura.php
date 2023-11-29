<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta SQL a través de API Laravel</title>
</head>
<body>
<a href="finanzas">Ir a finanzas</a>

<h2>Datos de la Consulta</h2>
<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sige";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL con LIMIT para la paginación
$sql = "SELECT cliente.nom_empresa,venta.fecha,CAST(venta.total_venta / detalle_venta.precio_unidad AS INT) as total,producto_servicio.nom_producto_servicio
FROM detalle_venta
        CROSS JOIN cliente 
        CROSS JOIN venta 
        CROSS JOIN producto_servicio
        WHERE cliente.idCliente = 1";

$result = $conn->query($sql);

// Aquí podrías tener más lógica para generar la factura electrónica, como firmas digitales, etc.

// Imprimir la factura
// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<html>";
    echo "<head>";
    echo "<title>Tu Factura Electrónica</title>";
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>";
    echo "</head>";
    echo "<body>";

    echo "<h2>Factura Electrónica</h2>";

    echo "<table>
            <tr>
                <th>Nombre Empresa</th>
                <th>Fecha</th>
                <th>Total Venta</th>
                <th>Nombre Producto</th>         
            </tr>";

    // Imprimir datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom_empresa"] . "</td>";
        echo "<td>" . $row["fecha"] . "</td>";
        echo "<td>$" . $row["total"] . "</td>";
        echo "<td>" . $row["nom_producto_servicio"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Puedes agregar más información, como el total general, impuestos, etc.

    echo "</body>";
    echo "</html>";
} else {
    echo "0 resultados";
}



?>

</body>
</html>
