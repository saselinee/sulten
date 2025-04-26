<?php
session_start();
require_once 'db.php';

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

    form {
      background-color: white;
      max-width: 400px;
      margin: 0 auto;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="submit"] {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #F78C1F;
      color: white;
      border: none;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>
<header>
  <h2>SULTEN</h2>
  <nav>
    <a href="index.php">Forside</a>
    <a href="bestil.php">Bestil Mad</a>
    <a href="menu.php">Ugens Menu</a>
    <a href="login.html">Login</a>
    <a href="opretbruger.php">Opret Bruger</a>
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
      require_once 'flash.php';
      displayFlash();
      ?>

    <section>
      <input type="submit" value="Log ind">
    </section>
  </form>
</main>
</body>
</html>