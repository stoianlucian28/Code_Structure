<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'codestructure';

$conn = new MySQLi($host, $user, $pass, $db_name);

if($conn->connect_error){

    die('Database conncection error: '. $conn->connect_error);
}
