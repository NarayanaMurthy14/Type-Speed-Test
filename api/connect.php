<?php
$connect = mysqli_connect("localhost", "root", "", "speed");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
