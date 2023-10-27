<?php
include 'dbconnection.php';

$piatto = $_POST['piatto'];

// Controllo se il piatto è già nel database
$query = "SELECT * FROM Piatto WHERE nome = '$piatto'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    // Se il piatto non è nel database, lo aggiungo
    $query = "INSERT INTO Piatto (nome) VALUES ('$piatto')";
    if(mysqli_query($conn, $query)) {
        echo "Piatto aggiunto con successo";
    } else {
        echo "Errore nell'aggiunta del piatto: " . mysqli_error($conn);
    }
} else {
    echo "Il piatto è già presente nel database";
}

mysqli_close($conn);
?>
