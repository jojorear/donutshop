<?php
//logs the user out by destroying the session and heading back to the login page or index.php
session_start();
session_destroy();
header('location:index.php');
?>