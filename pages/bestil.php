<?php
// Starter sessionen
session_start();

// Inkluderer databaseforbindelse og flash-besked funktioner
require_once '../includes/db.php';
require_once '../includes/flash.php';

// Tjekker om brugeren er logget ind, ellers sendes til login
if(!isset($_SESSION['user_mail'])) {
    header("Location: login.php");
    exit();
}

// Henter alle retter fra databasen og sorterer dem alfabetisk
$meals = [];
$sql = "SELECT meal_id, meal_name FROM meals ORDER BY meal_name ASC";
$result = Query($sql);

if ($result){
    while ($row = mysqli_fetch_assoc($result)){
        $meals[] = $row; // Tilføjer hver ret til listen
    }
}

// Håndterer formularindsendelse
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $dag = $_POST['dag'];
    $meal_id = $_POST['meal_id'];
    $mail = $_SESSION['user_mail'];

    // Indsætter bestillingen i databasen
    $sql = "INSERT INTO orders (mail, dag, meal_id) VALUES ('$mail', '$dag', '$meal_id')";
    $result = Query($sql);

    // Hvis bestillingen lykkedes, vises succesbesked og viderestilles
    if ($result){
        $_SESSION['succes']  = "Bestilling modtaget!";
        header("Location: minebestillinger.php");
        exit();
    } else {
        // Hvis noget gik galt, vises fejlbesked og viderestilles
        $_SESSION['error'] = "Noget gik galt. Prøv igen.";
        header("Location: bestil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestil Mad – SULTEN</title>
    <!-- Importerer skrifttype og CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<main>
    <!-- Viser eventuelle flash-beskeder -->
    <?php displayFlash(); ?>

    <header>
        <h2>SULTEN</h2>

        <!-- Navigation til forskellige sider -->
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

    <h1>Bestil Din Frokost</h1>

    <!-- Formular til at vælge dag og ret -->
    <form action="bestil.php" method="post">
        <section>
            <label for="dag">Vælg dag:</label>
            <select id="dag" name="dag">
                <option>Mandag</option>
                <option>Tirsdag</option>
                <option>Onsdag</option>
                <option>Torsdag</option>
                <option>Fredag</option>
            </select>
        </section>

        <section>
            <label for="meal_id">Vælg ret:</label>
            <select id="meal_id" name="meal_id" required>
                <!-- Indsætter valgmuligheder for retter -->
                <?php foreach ($meals as $meal):  ?>
                    <option value="<?php echo $meal['meal_id']; ?>">
                        <?php echo htmlspecialchars($meal['meal_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </section>

        <section>
            <!-- Send-knap til at bestille -->
            <input type="submit" value="Bestil Nu">
        </section>
    </form>
</main>
</body>
</html>
