<?php
$servername = "db4free.net";
$username = "foodcopilot";
$password = "foodcopilot";
$dbname = "menu_ristorante";

// Creare una connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllare la connessione
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}

echo "Connesso con successo";
?>
