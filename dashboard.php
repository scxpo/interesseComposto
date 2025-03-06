<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

require 'db.php';

// Salvataggio dei calcoli
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $investimentoIniziale = $_POST['investimentoIniziale'];
    $risparmioMensile = $_POST['risparmioMensile'];
    $tassoAnnuale = $_POST['tassoAnnuale'];
    $durata = $_POST['durata'];

    $query = "INSERT INTO calcoli (username, investimentoIniziale, risparmioMensile, tassoAnnuale, durata) 
              VALUES (:username, :investimentoIniziale, :risparmioMensile, :tassoAnnuale, :durata)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->bindParam(':investimentoIniziale', $investimentoIniziale);
    $stmt->bindParam(':risparmioMensile', $risparmioMensile);
    $stmt->bindParam(':tassoAnnuale', $tassoAnnuale);
    $stmt->bindParam(':durata', $durata);
    $stmt->execute();
}

?>

<form method="POST">
    <input type="number" name="investimentoIniziale" placeholder="Investimento Iniziale" required>
    <input type="number" name="risparmioMensile" placeholder="Risparmio Mensile" required>
    <input type="number" name="tassoAnnuale" placeholder="Crescita Annuale" required>
    <input type="number" name="durata" placeholder="Durata in Anni" required>
    <button type="submit">Salva Calcolo</button>
</form>
