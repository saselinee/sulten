<?php
// Starter sessionen
session_start();

// Inkluderer databaseforbindelse og flash-funktioner
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Henter alle måltider fra databasen og sorterer dem efter ID
$sql = "SELECT meal_name, meal_description, meal_price FROM meals ORDER BY meal_id ASC";
$result = Query($sql);
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ugens Menu – SULTEN</title>
    <!-- Import af skrifttype og CSS-stil -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h2>SULTEN</h2>

    <!-- Navigation med forskellig visning afhængig af login-status -->
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
    <h1>Ugens Menu</h1>

    <!-- Hvis der findes måltider i databasen, vis dem -->
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <section class="menu-dag">
                <!-- Viser navnet på retten -->
                <h2><?php echo htmlspecialchars($row['meal_name']); ?></h2>

                <!-- Viser beskrivelse af retten -->
                <p><?php echo htmlspecialchars($row['meal_description']); ?></p>

                <!-- Viser prisen i dansk format -->
                <p><strong>Pris:</strong> <?php echo number_format($row['meal_price'], 2, ',', '.'); ?> kr.</p>
            </section>
        <?php endwhile; ?>
    <?php else: ?>
        <!-- Hvis der ikke er nogen retter -->
        <p style="text-align: center;">Ingen retter fundet.</p>
    <?php endif; ?>
</main>
</body>
</html>
