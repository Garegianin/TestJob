<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "testjob1";

$conn = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($conn, "utf-8");
// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}