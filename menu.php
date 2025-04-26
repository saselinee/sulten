<?php
session_start();
?>

<!DOCTYPE html>
<html lang="da">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ugens Menu – SULTEN</title>
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

    main {
      padding: 2rem;
    }

    h1 {
      text-align: center;
      color: #F78C1F;
      margin-bottom: 2rem;
    }

    section.menu-dag {
      background-color: white;
      border-radius: 12px;
      padding: 1rem 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    section.menu-dag h2 {
      color: #6DBE45;
      margin-bottom: 0.5rem;
    }

    section.menu-dag p {
      font-size: 1rem;
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
    <a href="menu.html">Ugens Menu</a>
  <?php if (isset($_SESSION['user_mail'])): ?>
      <a href="logout.php">Log ud</a>
  <?php else: ?>
      <a href="login.php">Login</a>
      <a href="opretbruger.php">Opret Bruger</a>
  <?php endif; ?>
  </nav>
</header>

<main>
  <h1>Ugens Menu</h1>

  <section class="menu-dag">
    <h2>Mandag</h2>
    <p>Frikadeller med kartoffelsalat</p>
  </section>

  <section class="menu-dag">
    <h2>Tirsdag</h2>
    <p>Kyllingewraps med grønt og dressing</p>
  </section>

  <section class="menu-dag">
    <h2>Onsdag</h2>
    <p>Vegetarisk pastasalat med feta</p>
  </section>

  <section class="menu-dag">
    <h2>Torsdag</h2>
    <p>Boller i karry med ris</p>
  </section>

  <section class="menu-dag">
    <h2>Fredag</h2>
    <p>Pizza-slice og salat</p>
  </section>
</main>
</body>
</html>