<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['usuario'] = $user['username'];
        $_SESSION['dept'] = $user['departamento'];
        header("Location: index.php");
    } else {
        $error = "Acceso denegado";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Almacén</title>
    <style>
        body { background: #121212; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: #1e1e1e; padding: 30px; border-radius: 10px; border: 1px solid #333; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #444; background: #2c2c2c; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <form method="POST">
        <h2 style="text-align: center;">Iniciar Sesión</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Usuario (admin)" required>
        <input type="password" name="password" placeholder="Contraseña (1234)" required>
        <button type="submit">ENTRAR</button>
    </form>
</body>
</html>