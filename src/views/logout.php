<?php
session_start(); 
include '../classes/User.php';
$user = unserialize($_SESSION['user']);
$user->logout();
exit();
?>