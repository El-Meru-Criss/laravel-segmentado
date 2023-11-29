<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta SQL a través de API Laravel</title>
</head>
<body>
<a href="productos">Ir a Productos</a>
<a href="factura">Ir a factura</a>

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

// Consulta SQL
$sql = "SELECT DISTINCT detalle_venta.precio_unidad,producto_servicio.precio,venta.fecha,producto_servicio.cantidad_stock,producto_provedoor.precio_compra,productos_pedidos.cantidad,orden_compra.total_compra,venta.total_venta FROM detalle_venta 
INNER JOIN venta ON detalle_venta.venta_idventa = venta.idventa
CROSS JOIN producto_servicio 
CROSS JOIN producto_provedoor
CROSS JOIN productos_pedidos
CROSS JOIN orden_compra
order by venta.fecha";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Imprimir la tabla HTML
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
    echo "<table border='1'>";
    echo "<tr><th>Total Venta</th><th>Precio Unidad</th><th>Nombre Empresa</th><th>Cantidad Stock</th><th>Precio Compra</th><th>Cantidad</th><th>Fecha</th><th>Total Compra</th></tr>";

    // Imprimir datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["total_venta"] . "</td>";
        echo "<td>" . $row["precio_unidad"] . "</td>";
        echo "<td>" . $row["precio"] . "</td>";
        echo "<td>" . $row["cantidad_stock"] . "</td>";
        echo "<td>" . $row["precio_compra"] . "</td>";
        echo "<td>" . $row["cantidad"] . "</td>";
        echo "<td>" . $row["fecha"] . "</td>";
        echo "<td>" . $row["total_compra"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>
