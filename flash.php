<?php
function displayFlash(){
    if (isset($_SESSION['success'])) {
        echo '<div style="background-color: #6DBE45; color: white; padding: 10px; border-radius: 8px; margin: 10px 0;">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error'])) {
        echo '<div style="background-color: #e74c3c; color: white; padding: 10px; border-radius: 8px; margin: 10px 0;">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
}
?>