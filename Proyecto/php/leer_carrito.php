<?php
include '../php/db.php';

$sql = "SELECT carrito.id, productos.nombre, productos.precio, carrito.cantidad
        FROM carrito
        JOIN productos ON carrito.producto_id = productos.id";

$result = $conn->query($sql);
$carrito = [];

while ($row = $result->fetch_assoc()) {
    $carrito[] = $row;
}

echo json_encode($carrito);
?>
