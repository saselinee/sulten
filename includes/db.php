<?php

// Initialiserer forbindelsesvariablen som null
$conn = null;

/**
 * Funktion til at udføre en SQL-forespørgsel
 * @param string $sql - SQL-forespørgslen, der skal udføres
 * @return mysqli_result|bool - Resultatet af forespørgslen eller false ved fejl
 */
function Query($sql)
{
    // Gør den globale forbindelsesvariabel tilgængelig inden for funktionen
    global $conn;

    // Hvis der ikke allerede er en aktiv forbindelse, opret en ny
    if (!$conn) {
        // Definerer databaseforbindelsesparametre
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'sulten_db';

        // Opretter forbindelse til MySQL-databasen
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Tjekker om forbindelsen blev oprettet korrekt
        if (!$conn) {
            // Stopper scriptet og viser en fejlmeddelelse, hvis forbindelsen fejler
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Udfører SQL-forespørgslen ved hjælp af den aktive forbindelse
    return mysqli_query($conn, $sql);
}

