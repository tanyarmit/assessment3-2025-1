<?php

define('HOST', strstr($_SERVER['SERVER_NAME'], 'localhost') ? 'localhost' : 'talsprddb02.int.its.rmit.edu.au');
define('USER', strstr($_SERVER['SERVER_NAME'], 'localhost') ? 'root' : 'e102767');
define('PASS', strstr($_SERVER['SERVER_NAME'], 'localhost') ? '' : 'JACOB5_pw');
define('DB', strstr($_SERVER['SERVER_NAME'], 'localhost') ? 'gamesrus' : 'e102767');

// Create connection
$conn = new mysqli(HOST, USER, PASS, DB);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
