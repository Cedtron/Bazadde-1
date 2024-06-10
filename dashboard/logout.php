<?php
session_start();

    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['user']);
    unset($_SESSION['id']);

header("location: login.php");

?>