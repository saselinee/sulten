<?php
// Starter sessionen
session_start();

// Henter en tilfældig ret fra TheMealDB API
$apiUrl = "https://www.themealdb.com/api/json/v1/1/random.php";
$response = @file_get_contents($apiUrl); // Henter JSON-data fra API (med '@' for at undgå warnings)
$data = json_decode($response, true); // Dekoder JSON-svaret til en PHP-array

// Standardværdi hvis der ikke er en ret
$mealName = "Ingen dagens ret i dag.";
$mealThumb = "";

// Hvis der findes en ret, gem navnet og billedet
if ($data && isset($data['meals'][0])){
    $mealName = $data['meals'][0]['strMeal'];
    $mealThumb = $data['meals'][0]['strMealThumb'];
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SULTEN – Forside</title>
    <!-- Import af skrifttype og CSS-stil -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h2>SULTEN</h2>

    <!-- Navigation med betingelser baseret på login-status -->
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

<!-- Velkomstsektion -->
<section class="hero">
    <h1>Velkommen til SULTEN!</h1>
    <p>Bestil nemt din frokost og se hvad kantinen tilbyder i denne uge. Nemt, hurtigt og lækkert!</p>
    <a href="bestil.php" class="btn">Bestil Mad</a>
</section>

<!-- Sektion til dagens ret -->
<section class="dagens-ret" style="padding: 2rem; text-align: center;">
    <h2 style="color: #6dbe45;">Dagens ret</h2>
    <p style="font-size: 1.5rem; margin: 1rem 0;"><?php echo htmlspecialchars($mealName); ?></p>

    <!-- Viser billede af retten hvis det findes -->
    <?php if (!empty($mealThumb)): ?>
        <img src="<?php echo htmlspecialchars($mealThumb); ?>" alt="Dagent ret" style="max-width: 300px; border-radius: 12px">
    <?php endif; ?>
</section>

<!-- Kortoversigt over funktioner -->
<section class="sections">
    <article class="section-card">
        <h2>Bestil Mad</h2>
        <p>Vælg dine favoritter til frokost og afhent dem direkte i kantinen.</p>
    </article>
    <article class="section-card">
        <h2>Ugens Menu</h2>
        <p>Se hvad kantinen tilbyder af varme og kolde retter hele ugen.</p>
    </article>
    <article class="section-card">
        <h2>Log ind eller Opret Bruger</h2>
        <p>Gem dine præferencer og se tidligere bestillinger.</p>
    </article>
</section>
</body>
</html>
