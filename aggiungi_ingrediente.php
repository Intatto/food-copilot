<?php
include 'dbconnection.php';

$ingrediente = $_POST['ingrediente'];
$preparazione = $_POST['preparazione'];
$quantita = $_POST['quantita'];

// Controllo se l'ingrediente è già nel database
$query = "SELECT * FROM Ingrediente WHERE nome = '$ingrediente'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    // Se l'ingrediente non è nel database, lo aggiungo
    $query = "INSERT INTO Ingrediente (nome) VALUES ('$ingrediente')";
    if(mysqli_query($conn, $query)) {
        echo "Ingrediente aggiunto con successo";
    } else {
        echo "Errore nell'aggiunta dell'ingrediente: " . mysqli_error($conn);
    }
}

// Collego l'ingrediente alla preparazione
$query = "SELECT id FROM Preparazione WHERE nome = '$preparazione'";
$preparazione_id = mysqli_fetch_assoc(mysqli_query($conn, $query))['id'];

$query = "SELECT id FROM Ingrediente WHERE nome = '$ingrediente'";
$ingrediente_id = mysqli_fetch_assoc(mysqli_query($conn, $query))['id'];

$query = "INSERT INTO Preparazione_Ingrediente (id_preparazione, id_ingrediente, quantita) VALUES ('$preparazione_id', '$ingrediente_id', '$quantita')";
if(mysqli_query($conn, $query)) {
    echo "Ingrediente collegato alla preparazione con successo";
} else {
    echo "Errore nel collegamento dell'ingrediente alla preparazione: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
