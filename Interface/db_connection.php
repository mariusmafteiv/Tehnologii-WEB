<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Crearea conexiunii
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificarea conexiunii
if ($conn->connect_error) {
  die("Conexiune eșuată: " . $conn->connect_error);
}
?>
