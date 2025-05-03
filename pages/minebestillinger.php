<?php
// Starter sessionen
session_start();

// Inkluderer databaseforbindelse og flash-funktioner
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Tjekker om brugeren er logget ind – ellers sendes de til login
if (!isset($_SESSION['user_mail'])){
    header("Location: login.php");
    exit();
}

// Gemmer brugerens mail fra sessionen
$mail = $_SESSION['user_mail'];

// Henter brugerens bestillinger og tilhørende ret-navne fra databasen
$sql = "SELECT orders.dag, meals.meal_name
        FROM orders
        JOIN meals ON orders.meal_id = meals.meal_id
        WHERE orders.mail='$mail'
        ORDER BY orders.meal_id DESC";
$result = Query($sql);
?>

<!doctype html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0>">
    <title>Mine Bestillinger - SULTEN</title>
    <!-- Import af skrifttype og CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- Viser eventuelle flash-beskeder -->
<?php displayFlash(); ?>

<header>
    <h2>SULTEN</h2>

    <!-- Navigation der viser brugerstatus -->
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

<!-- Hvis der er bestillinger, vis dem i en tabel -->
<?php if ($result && mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>Dag</th>
            <th>Ret</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo  htmlspecialchars($row['dag']); ?></td>
                <td><?php echo htmlspecialchars($row['meal_name']); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <!-- Hvis ingen bestillinger er fundet -->
    <p style="text-align: center;">Du har ingen bestillinger endnu.</p>
<?php endif; ?>

</body>
</html>
