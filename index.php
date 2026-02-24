<?php
session_start();
if (!isset($_SESSION['usuario'])) { header("Location: login.php"); exit(); }
include 'conexion.php';

$productos = $pdo->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Almacén</title>
    <style>
        body { background: #0b0e14; color: #e0e0e0; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #161b22; }
        th, td { padding: 12px; border: 1px solid #30363d; text-align: left; }
        th { background: #21262d; color: #58a6ff; }
        .stock-bajo { color: #ff7b72; font-weight: bold; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 12px; }
        .badge-warning { background: #bb8009; color: black; }
        .badge-ok { background: #238636; color: white; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 6px; font-size: 14px; }
        .btn-add { background: #238636; color: white; }
        .btn-del { color: #f85149; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROYECTO 2 - Gestión de almacén</h1>
        <div>
            <span>👤 <?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['dept']; ?>)</span> | 
            <a href="logout.php" style="color:#f85149">Salir</a>
        </div>
    </div>

    <div style="margin: 20px 0;">
        <a href="insertar.php" class="btn btn-add">+ Alta de productos</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>PRODUCTO</th>
                <th>CATEGORÍA</th>
                <th>PROVEEDOR</th>
                <th>CANTIDAD</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p['nombre'] ?></td>
                <td><?= $p['categoria'] ?></td>
                <td><?= $p['proveedor'] ?></td>
                <td class="<?= ($p['stock'] <= $p['stock_minimo']) ? 'stock-bajo' : '' ?>">
                    <?= $p['stock'] ?>
                </td>
                <td>
                    <?php if ($p['stock'] <= $p['stock_minimo']): ?>
                        <span class="badge badge-warning">⚠️ Stock Bajo</span>
                    <?php else: ?>
                        <span class="badge badge-ok">En stock</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="eliminar.php?id=<?= $p['id'] ?>" class="btn-del" onclick="return confirm('¿Eliminar producto?')">🗑️ Borrar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>