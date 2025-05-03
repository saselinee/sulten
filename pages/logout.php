<?php
// Starter sessionen
session_start();

// Fjerner alle session-variabler
session_unset();

// Ødelægger sessionen helt
session_destroy();

// Sender brugeren tilbage til login-siden
header("Location: login.php");
exit();
