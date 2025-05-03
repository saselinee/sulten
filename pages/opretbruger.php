<?php
// Inkluderer databaseforbindelse og flash-funktioner
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Tjekker om formularen er sendt via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $bekraeftelse_kodeord = $_POST['bekraeftelse_kodeord'];

    // Tjekker om de to kodeord matcher
    if ($password === $bekraeftelse_kodeord) {

        // Hasher kodeordet før det gemmes
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Indsætter ny bruger i databasen
        $sql = "INSERT INTO users (mail, password) VALUES ('$mail', '$hashedPassword')";
        $result = Query($sql);

        // Viser om oprettelsen lykkedes
        if ($result) {
            echo "Bruger oprettet";
        } else{
            echo "Bruger oprettelse fejlede";
        }
    } else {
        // Viser fejl hvis kodeordene ikke matcher
        echo "Kodeordene er ikke ens";
    }
}
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opret Bruger – SULTEN</title>
    <!-- Import af skrifttype og CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h2>SULTEN</h2>

    <!-- Navigation afhængig af login-status -->
    <nav id="navbar">
        <a href="index.php">Forside</a>
        <a href="bestil.php">Bestil Mad</a>
        <a href="menu.php">Ugens Menu</a>
        <?php if (isset($_SESSION['user_mail'])): ?>
            <a href="minebestillinger.php">Mine Bestillinger</a>
            <a href="logout.php">Log ud</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="opretbruger.php">Opret Bruger</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <h1>Opret Bruger</h1>

    <!-- Formular til brugeroprettelse -->
    <form action="#" method="post">
        <section>
            <label for="mail">Mail:</label>
            <input type="email" id="mail" name="mail" required>
        </section>

        <section>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </section>

        <section>
            <label for="bekraeftelse_kodeord">Bekræft Kodeord:</label>
            <input type="password" id="bekraeftelse_kodeord" name="bekraeftelse_kodeord" required>
            <a href="login.php">Har du allerede en konto? Log ind her</a>
        </section>

        <section>
            <input type="submit" value="Opret Bruger">
        </section>
    </form>
</main>
</body>
</html>
