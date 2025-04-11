<?php
include 'db.php';

$producto_id = $_POST['producto_id'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO carrito (producto_id, cantidad) VALUES ('$producto_id', '$cantidad')";
$conn->query($sql);

header("Location: carrito.php");
?>
