

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>


<?php
session_start(); // Avvia una sessione per gestire la sessione dell'utente

// Se l'utente è già loggato, reindirizzalo alla dashboard o alla pagina principale
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php"); // o un'altra pagina protetta
    exit();
}

// Se il form di login è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Qui dovresti connetterti al database per verificare le credenziali
    require 'db.php'; // Assicurati di avere il file db.php connesso al database

    // Query per verificare le credenziali
    $query = "SELECT * FROM utenti WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Se le credenziali sono corrette, avvia la sessione
    if ($stmt->rowCount() > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Reindirizza alla pagina principale o dashboard
        exit();
    } else {
        echo "Username o password errati!";
    }
}

