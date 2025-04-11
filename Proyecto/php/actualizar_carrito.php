<?php
include '../php/db.php';

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

$sql = "UPDATE carrito SET cantidad='$cantidad' WHERE id='$id'";
$conn->query($sql);

header("Location: carrito.php");
?>
