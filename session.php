<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "productos";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Conectado correctamente a la base de datos";
?> 