<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Fetch meals from database
$sql = "SELECT meal_name, meal_description, meal_price FROM meals ORDER BY meal_id ASC";
$result = Query($sql);
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ugens Menu – SULTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h2>SULTEN</h2>

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

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <section class="menu-dag">
                <h2><?php echo htmlspecialchars($row['meal_name']); ?></h2>
                <p><?php echo htmlspecialchars($row['meal_description']); ?></p>
                <p><strong>Pris:</strong> <?php echo number_format($row['meal_price'], 2, ',', '.'); ?> kr.</p>
            </section>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center;">Ingen retter fundet.</p>
    <?php endif; ?>
</main>
</body>
</html>
