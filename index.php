<?php
session_start();
?>


<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SULTEN – Forside</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F5F1E3;
            color: #2F3542;
        }

        header {
            background-color: #6DBE45;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            margin-left: 1rem;
            text-decoration: none;
            color: white;
            font-weight: 600;
        }

        .hero {
            padding: 2rem;
            text-align: center;
            background-color: #fff;
        }

        .hero h1 {
            font-size: 2.5rem;
            color: #F78C1F;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn {
            background-color: #F78C1F;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
        }

        section.sections {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        article.section-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        article.section-card h2 {
            color: #6DBE45;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 768px) {
            section.sections {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>
<body>
<header>
    <h2>SULTEN</h2>
    <p>Logget ind som: <?php echo $_SESSION['user_mail']; ?></p>
    <nav>
        <a href="index.php">Forside</a>
        <a href="bestil.php">Bestil Mad</a>
        <a href="menu.php">Ugens Menu</a>
        <?php if (isset($_SESSION['user_mail'])): ?>
            <a href="logout.php">Log ud</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="opretbruger.php">Opret Bruger</a>
        <?php endif; ?>
    </nav>
</header>

<section class="hero">
    <h1>Velkommen til SULTEN!</h1>
    <p>Bestil nemt din frokost og se hvad kantinen tilbyder i denne uge. Nemt, hurtigt og lækkert!</p>
    <a href="bestil.php" class="btn">Bestil Mad</a>
</section>

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