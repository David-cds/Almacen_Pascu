<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO productos (nombre, categoria, proveedor, stock, stock_minimo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['nombre'], $_POST['categoria'], $_POST['proveedor'], $_POST['stock'], $_POST['minimo']]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
    <style>
        body { background: #0b0e14; color: white; font-family: sans-serif; padding: 40px; }
        form { max-width: 400px; margin: auto; background: #161b22; padding: 20px; border-radius: 8px; }
        label { display: block; margin-top: 10px; color: #8b949e; }
        input { width: 100%; padding: 8px; margin-top: 5px; background: #0d1117; border: 1px solid #30363d; color: white; border-radius: 5px; box-sizing: border-box; }
        .btn-save { background: #238636; border: none; color: white; padding: 10px; width: 100%; margin-top: 20px; cursor: pointer; border-radius: 6px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Alta de Producto</h2>
        <label>Nombre</label><input type="text" name="nombre" required>
        <label>Categoría</label><input type="text" name="categoria">
        <label>Proveedor</label><input type="text" name="proveedor">
        <label>Cantidad Disponible</label><input type="number" name="stock" required>
        <label>Stock Mínimo (para aviso)</label><input type="number" name="minimo" value="5">
        <button type="submit" class="btn-save">Guardar en Inventario</button>
        <p style="text-align: center;"><a href="index.php" style="color: #58a6ff;">Volver</a></p>
    </form>
</body>
</html>