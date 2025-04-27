<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/flash.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $mail = $_POST['mail'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE mail='$mail'";
  $result = Query($sql);

  if ($result && mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $hashedPassword = $row['password'];
  }

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['user_mail'] = $mail;

        $_SESSION['success'] = "Du er logget ind som $mail!";
        header("Location: bestil.php");
        exit();
    } else {
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
  <h1>Login</h1>
  <form action="#" method="post">
    <section>
      <label for="mail">Mail:</label>
      <input type="email" id="mail" name="mail" required>
    </section>

    <section>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
    </section>

      <?php
      displayFlash();
      ?>

    <section>
      <input type="submit" value="Log ind">
    </section>
  </form>
</main>
</body>
</html>