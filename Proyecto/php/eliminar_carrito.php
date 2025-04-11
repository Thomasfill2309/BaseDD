<?php
include '../php/db.php';

$id = $_POST['id'];

$sql = "DELETE FROM carrito WHERE id='$id'";
$conn->query($sql);

header("Location: carrito.php");
?>
