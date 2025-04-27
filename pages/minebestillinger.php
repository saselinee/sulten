<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/flash.php';

if (!isset($_SESSION['user_mail'])){
    header("Location: login.php");
    exit();
}

$mail = $_SESSION['user_mail'];

// Fetch user orders
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php displayFlash(); ?>
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
<p style="text-align: center;">Du har ingen bestillinger endnu.</p>
<?php endif; ?>

</body>
</html>
