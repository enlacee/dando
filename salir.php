<?php
session_start();

$_SESSION["email"] = NULL;
unset($_SESSION["email"]);

session_destroy();

header("Location: index.php")
?>