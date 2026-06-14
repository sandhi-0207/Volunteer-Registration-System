<?php

$conn = mysqli_connect("localhost", "root", "", "volunteer_system");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>
