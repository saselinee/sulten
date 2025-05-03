<?php
// Funktion til at vise midlertidige beskeder (flash messages) til brugeren
function displayFlash(){
    // Tjekker om der er en 'success'-besked i sessionen
    if (isset($_SESSION['success'])) {
        // Viser beskeden i en grøn boks
        echo '<div style="background-color: #6DBE45; color: white; padding: 10px; border-radius: 8px; margin: 10px 0;">' . $_SESSION['success'] . '</div>';
        // Fjerner beskeden fra sessionen, så den kun vises én gang
        unset($_SESSION['success']);
    }

    // Tjekker om der er en 'error'-besked i sessionen
    if (isset($_SESSION['error'])) {
        // Viser beskeden i en rød boks
        echo '<div style="background-color: #e74c3c; color: white; padding: 10px; border-radius: 8px; margin: 10px 0;">' . $_SESSION['error'] . '</div>';
        // Fjerner beskeden fra sessionen, så den kun vises én gang
        unset($_SESSION['error']);
    }
}

