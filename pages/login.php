<?php
// Starter sessionen
session_start();

// Inkluderer databaseforbindelse og flash-besked funktioner
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Hvis formularen er sendt (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // Henter brugeren med den indtastede e-mail
    $sql = "SELECT * FROM users WHERE mail='$mail'";
    $result = Query($sql);

    // Hvis brugeren findes, gem den hash'ede adgangskode
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
    }

    // Verificerer at adgangskoden matcher hash'en
    if (password_verify($password, $hashedPassword)) {
        // Gemmer brugerens e-mail i sessionen (logget ind)
        $_SESSION['user_mail'] = $mail;

        // Giver en succesbesked og sender videre til bestilling
        $_SESSION['success'] = "Du er logget ind som $mail!";
        header("Location: bestil.php");
        exit();
    } else {
        // Hvis adgangskoden er forkert, vis fejlbesked og send tilbage
        $_SESSION['error'] = "Forkert adgangskode.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – SULTEN</title>
    <!-- Skrifttype og CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h2>SULTEN</h2>

    <!-- Navigation med login/logud afhængig af session -->
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
    <h1>Login</h1>
    <!-- Loginformular -->
    <form action="#" method="post">
        <section>
            <label for="mail">Mail:</label>
            <input type="email" id="mail" name="mail" required>
        </section>

        <section>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </section>

        <!-- Viser flashbeskeder -->
        <?php displayFlash(); ?>

        <section>
            <input type="submit" value="Log ind">
        </section>
    </form>
</main>
</body>
</html>
