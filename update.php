<?php
require_once("./session.php");

$id = $_POST['id'];
$nuevoStock = $_POST['stock'];

$stmt = $conn->prepare("UPDATE producto SET stock = ? WHERE id = ?");
$stmt->bind_param("ii", $nuevoStock, $id);

if ($stmt->execute()) {
    echo "Stock actualizado correctamente";
} else {
    echo "Error al actualizar stock: " . $conn->error;
}

$stmt->close();
