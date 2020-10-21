<?php
$connect = mysqli_connect("localhost", "root", "", "test");

if (!$connect) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, "SET CHARACTER SET utf8");
mysqli_query($connect, "SET collation_connection = utf8_polish_ci");
?>