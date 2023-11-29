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
$sql = "SELECT 
            producto_servicio.nom_producto_servicio,
            producto_servicio.precio,
            producto_servicio.cantidad_stock,
            producto_provedoor.proveedor_idproveedor,
            producto_provedoor.precio_compra,
            orden_compra.fecha_creacion,
            orden_compra.total_compra,
            productos_pedidos.cantidad,
            producto_provedoor.precio_compra * productos_pedidos.cantidad AS venta
        FROM producto_servicio
        CROSS JOIN producto_provedoor
        CROSS JOIN productos_pedidos
        CROSS JOIN orden_compra
        ORDER BY orden_compra.fecha_creacion";

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    echo "<html>";
    echo "<head><title>Tu Título</title></head>";
    echo "<body>";
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
    echo "<tr>
            <th>Producto/Servicio</th>
            <th>Precio</th>
            <th>Cantidad en Stock Actual</th>
            <th>ID del Proveedor</th>
            <th>Precio de Compra</th>
            <th>Fecha de Creación de la Orden</th>
            <th>Total de la Orden</th>
            <th>Cantidad Productos Pedidos</th>
            <th>Total Pedidos</th>
            
            
          </tr>";

    // Imprimir datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom_producto_servicio"] . "</td>";
        echo "<td>" . $row["precio"] . "</td>";
        echo "<td>" . $row["cantidad_stock"] . "</td>";
        echo "<td>" . $row["proveedor_idproveedor"] . "</td>";
        echo "<td>" . $row["precio_compra"] . "</td>";
        echo "<td>" . $row["fecha_creacion"] . "</td>";
        echo "<td>" . $row["total_compra"] . "</td>";
        echo "<td>" . $row["cantidad"] . "</td>";
        echo "<td>" . $row["venta"] . "</td>";
        
        echo "</tr>";
    }

}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>
