<?php
include("includePHP/path.php");
session_start();

unset($_SESSION['id']); 
unset($_SESSION['admin']);
unset($_SESSION['email']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']); 
unset($_SESSION['message']);
unset($_SESSION['type']);
session_destroy();

header('location: ' . BASE_URL . '/index.php');