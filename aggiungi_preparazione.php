<?php
include 'dbconnection.php';

$preparazione = $_POST['preparazione'];
$piatto = $_POST['piatto'];

// Controllo se la preparazione è già nel database
$query = "SELECT * FROM Preparazione WHERE nome = '$preparazione'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    // Se la preparazione non è nel database, la aggiungo
    $query = "INSERT INTO Preparazione (nome) VALUES ('$preparazione')";
    if(mysqli_query($conn, $query)) {
        echo "Preparazione aggiunta con successo";
    } else {
        echo "Errore nell'aggiunta della preparazione: " . mysqli_error($conn);
    }
}

// Collego la preparazione al piatto
$query = "SELECT id FROM Piatto WHERE nome = '$piatto'";
$piatto_id = mysqli_fetch_assoc(mysqli_query($conn, $query))['id'];

$query = "SELECT id FROM Preparazione WHERE nome = '$preparazione'";
$preparazione_id = mysqli_fetch_assoc(mysqli_query($conn, $query))['id'];

$query = "INSERT INTO Piatto_Preparazione (id_piatto, id_preparazione) VALUES ('$piatto_id', '$preparazione_id')";
if(mysqli_query($conn, $query)) {
    echo "Preparazione collegata al piatto con successo";
} else {
    echo "Errore nel collegamento della preparazione al piatto: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
