<?php
include 'conexion.php';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: index.php");
?>