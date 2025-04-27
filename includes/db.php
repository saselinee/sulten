<?php

$conn = null;

function Query($sql)
{
    global $conn;
    if (!$conn) {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'sulten_db';
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    return mysqli_query($conn, $sql);
}
